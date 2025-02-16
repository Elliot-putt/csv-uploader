<?php

namespace Feature\Controllers;

use App\Modules\Homeowner\Services\HomeownerService;
use Illuminate\Http\UploadedFile;
use Mockery;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeownerUploadControllerTest extends TestCase {
    public function setUp(): void
    {
        parent::setUp();

        $this->homeownerService = $this->mock(HomeownerService::class);
    }
    #[Test]
    public function it_can_upload_homeowners_successfully()
    {
        $file = UploadedFile::fake()->create('homeowners.csv', 100);

        $this->homeownerService
            ->shouldReceive('uploadHomeowners')
            ->once();

        $response = $this->json('POST', '/homeowners/upload', [
            'file' => $file
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Homeowners uploaded successfully.');
    }

    #[Test]
    public function it_can_upload_homeowners_successfully_with_real_data()
    {
        $file = new UploadedFile(
            base_path('tests/Fixtures/examples-4-.csv'),
            'examples-4-.csv',
            'text/csv',
            null,
            true
        );

        $this->homeownerService
            ->shouldReceive('uploadHomeowners')
            ->with(Mockery::on(function ($arguments) use ($file) {
                return $arguments['file']->getClientOriginalName() === $file->getClientOriginalName();
            }))
            ->once();

        $response = $this->json('POST', '/homeowners/upload', [
            'file' => $file
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Homeowners uploaded successfully.');
    }

    #[Test]
    public function it_can_process_real_file_without_mocking()
    {
        $this->app->forgetInstance(HomeownerService::class);

        $file = new UploadedFile(
            base_path('tests/Fixtures/examples-4-.csv'),
            'examples-4-.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->json('POST', '/homeowners/upload', [
            'file' => $file
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Homeowners uploaded successfully.');

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mr',
            'first_name' => 'John',
            'initial' => null,
            'last_name' => 'Doe'
        ]);
    }

    #[Test]
    public function it_can_process_various_name_formats()
    {
        $this->app->forgetInstance(HomeownerService::class);

        $file = new UploadedFile(
            base_path('tests/Fixtures/examples-4-.csv'),
            'examples-4-.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->json('POST', '/homeowners/upload', [
            'file' => $file
        ]);

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('success', 'Homeowners uploaded successfully.');

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mr',
            'first_name' => 'John',
            'initial' => null,
            'last_name' => 'Smith'
        ]);

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mr',
            'first_name' => null,
            'initial' => 'F',
            'last_name' => 'Fredrickson'
        ]);

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mrs',
            'first_name' => 'Faye',
            'initial' => null,
            'last_name' => 'Hughes-Eastwood'
        ]);

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mr',
            'first_name' => null,
            'initial' => null,
            'last_name' => 'Smith'
        ]);
        $this->assertDatabaseHas('homeowners', [
            'title' => 'Mrs',
            'first_name' => null,
            'initial' => null,
            'last_name' => 'Smith'
        ]);

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Prof',
            'first_name' => 'Alex',
            'initial' => null,
            'last_name' => 'Brogan'
        ]);

        $this->assertDatabaseHas('homeowners', [
            'title' => 'Dr',
            'first_name' => null,
            'initial' => 'P',
            'last_name' => 'Gunn'
        ]);
    }

}

<?php

namespace Tests\Modules\Homeowner\Unit\Services;

use App\Modules\Homeowner\Models\Homeowner;
use App\Modules\Homeowner\Services\HomeownerService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeownerServiceTest extends TestCase
{
    protected HomeownerService $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new HomeownerService();
    }


    #[Test]
    public function it_reduces_standard_name_formats()
    {

        $names = Collection::make([
            collect(['homeowner' => 'Mr Craig Charles']),
        ]);

        $results = $this->service->reduceHomeowners($names);

        $expectedHomeowners = [
            [
                'title' => 'Mr',
                'first_name' => 'Craig',
                'initial' => null,
                'last_name' => 'Charles'
            ]
        ];

        $this->assertEquals($expectedHomeowners, $results->toArray());
    }

    #[Test]
    public function it_reduces_name_with_initial()
    {
        $names = Collection::make([
            collect(['homeowner' => 'Mr J Smith']),
        ]);

        $results = $this->service->reduceHomeowners($names);

        $expectedHomeowners = [
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'J',
                'last_name' => 'Smith'
            ]
        ];

        $this->assertEquals($expectedHomeowners, $results->toArray());
    }

    #[Test]
    public function it_reduces_mr_and_mrs_format()
    {
        $names = Collection::make([
            collect(['homeowner' => 'Mr and Mrs Smith']),
        ]);

        $results = $this->service->reduceHomeowners($names);

        $expectedHomeowners = [
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ]
        ];

        $this->assertEquals($expectedHomeowners, $results->toArray());
    }

    #[Test]
    public function it_reduces_professional_titles()
    {
        $names = Collection::make([
            collect(['homeowner' => 'Dr John Smith']),
        ]);

        $results = $this->service->reduceHomeowners($names);

        $expectedHomeowners = [
            [
                'title' => 'Dr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Smith'
            ]
        ];

        $this->assertEquals($expectedHomeowners, $results->toArray());
    }

    #[Test]
    public function it_can_process_real_file()
    {
        $file = new UploadedFile(
            base_path('tests/Fixtures/examples-4-.csv'),
            'examples-4-.csv',
            'text/csv',
            null,
            true
        );


       $this->service->uploadHomeowners([
            'file' => $file
        ]);

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

        $this->service->uploadHomeowners([
            'file' => $file
        ]);

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

    #[Test]
    public function it_can_store_many_homeowners()
    {
        $homeowners = [
            [
                'title' => 'Mr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'F',
                'last_name' => 'Fredrickson'
            ],
            [
                'title' => 'Mrs',
                'first_name' => 'Faye',
                'initial' => null,
                'last_name' => 'Hughes-Eastwood'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Prof',
                'first_name' => 'Alex',
                'initial' => null,
                'last_name' => 'Brogan'
            ],
            [
                'title' => 'Dr',
                'first_name' => null,
                'initial' => 'P',
                'last_name' => 'Gunn'
            ]
        ];

        $this->service->storeMany($homeowners);

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
    }

    #[Test]
    public function it_can_import_homeowners()
    {
        $file = new UploadedFile(
            base_path('tests/Fixtures/examples-4-.csv'),
            'examples-4-.csv',
            'text/csv',
            null,
            true
        );

        $results = $this->service->importHomeowners($file);

        $this->assertInstanceOf(Collection::class, $results);
        $this->assertEquals('Mr John Smith', $results->first()['homeowner']);
    }

    #[Test]
    public function it_can_return_all_homeowners()
    {
        Homeowner::factory()->count(5)->create();

        $homeowners = $this->service->all();

        $this->assertCount(5, $homeowners);
    }
}

<?php

namespace Feature\Controllers;

use App\Modules\Homeowner\Models\Homeowner;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeownerExportControllerTest extends TestCase {

    #[Test]
    public function it_can_export_homeowners()
    {
        Homeowner::factory()->count(10)->create();

        $response = $this->json('GET', '/homeowners/export');

        $response->assertDownload('homeowners.xlsx');
    }
}

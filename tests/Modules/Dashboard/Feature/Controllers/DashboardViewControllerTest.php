<?php

namespace Tests\Modules\Dashboard\Feature\Controllers;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DashboardViewControllerTest extends TestCase {

    #[Test]
    public function test_it_can_return_the_dashboard_view(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertInertia(fn ($page) => $page
                ->component('Modules/Dashboard/Dashboard')
            );
    }
}

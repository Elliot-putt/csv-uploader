<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use JMac\Testing\Traits\AdditionalAssertions;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase ,AdditionalAssertions;


    public function login(User $user = null): User
    {
        $user ??= User::factory()->create();
        $this->actingAs($user);

        return $user;
    }

}

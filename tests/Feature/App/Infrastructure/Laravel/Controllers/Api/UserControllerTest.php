<?php

namespace Tests\Feature\App\Infrastructure\Laravel\Controllers\Api;

use App\Domain\Users\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Database\Factories\UserFactory;
// use Mockery;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_get_api_users(): void
    {

        $users = User::factory()
            ->count(5)
            ->create();

        Sanctum::actingAs(
            $users->first(),
            ['management']
        );

        $response = $this->getJson("/api/users");
        $response->assertOk();
        $this->assertCount(5, $response['users']);
    }
}

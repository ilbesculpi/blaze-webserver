<?php

use App\Domain\Users\Models\User;
use App\Domain\Users\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

uses(RefreshDatabase::class);

describe('Api::UserController', function () {

    describe('GET /api/users', function () {

        it('should retrieve the user list', function () {
            $users = User::factory()
                ->count(5)
                ->create();

            Sanctum::actingAs(
                $users->first(),
                ['management']
            );

            $response = $this->getJson("/api/users");
            $response->assertOk();
            expect($response['users'])->toHaveCount(5);
        });

    });

});

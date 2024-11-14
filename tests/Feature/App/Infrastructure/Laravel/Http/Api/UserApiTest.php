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

    describe('POST /api/users', function() {

        it('should create a new user account', function() {

            // create sysadmin user
            $user = User::factory()
                ->withRole('sysadmin')
                ->create();

            // generate a token for the acting user
            // $access_token = $user->createToken($user->role, $user->getTokenAbilities());

            Sanctum::actingAs(
                $user,
                ['sysadmin']
            );

            // $useCase = Mockery::mock('App\Domain\Users\UseCases\CreateUserAccount');
            // $useCase->shouldReceive('execute')
            //     ->once();

            $request = [
                'name' => 'John Doe',
                'role' => 'admin',
                'email' => 'jonhndoe@localhost',
                'password' => 'letmein',
            ];
            $response = $this->postJson("/api/users", $request);
            $response->assertOk();
        });

    });

});

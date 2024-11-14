<?php

use App\Domain\Users\Models\User;
use App\Domain\Users\Requests\CreateUserRequest;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\UseCases\CreateUserAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use Mockery;

describe('CreateAccount UseCase', function() {

    it('should create a new user account', function() {

        $userStub = new User();
        $userStub->id = 1;
        $userStub->name = 'John';
        $repository = Mockery::mock('App\Domain\Users\Services\UserService, App\Domain\Users\Repositories\UserRepository');
        $repository->shouldReceive('createUser')
            ->once()
            ->andReturn($userStub);
        $useCase = new CreateUserAccount($repository);

        $request = new CreateUserRequest('John Doe', 'johndoe@localhost', 'password', 'administrador');
        $user = $useCase->execute($request);
        expect($user)->toBeInstanceOf(User::class);
        expect($user->id)->toBe(1);
        expect($user->name)->toBe('John');
    });

    // it('should validate that creating user is sysadmin', function() {

    // });

});

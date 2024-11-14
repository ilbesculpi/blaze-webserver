<?php

use App\Domain\Users\Models\User;
use App\Domain\Users\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

describe('UserService', function () {

    describe('getUserList()', function () {

        it('should retrieve the user list', function () {
            $users = User::factory()
                ->count(5)
                ->create();
            $service = new UserService();
            $users = $service->getUserList();
            expect($users)->toHaveCount(5);
        });

    });

});

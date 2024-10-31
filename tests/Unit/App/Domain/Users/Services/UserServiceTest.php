<?php

namespace Tests\Unit\App\Domain\Users\Services;

use App\Domain\Users\Services\UserService;
use App\Domain\Users\Models\User;
use PHPUnit\Framework\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserServiceTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic unit test example.
     */
    public function testGetUserList()
    {
        // $users = User::factory()
        //     ->count(5)
        //     ->create();
        // $service = new UserService();
        // $users = $service->getUserList();
        // $this->assertCount(5, $users);
        $this->markTestIncomplete('TODO: find out how to spy on static User::get() method.');
    }
}

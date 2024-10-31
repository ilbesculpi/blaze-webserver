<?php

namespace Tests\Unit\App\Domain\Users\Services;

use App\Domain\Users\Models\User;
use App\Domain\Users\Services\UserService;
use PHPUnit\Framework\TestCase;
use Mockery;


class UserServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testGetUserList()
    {
        $mock = Mockery::mock('alias:App\Domain\Users\Models\User');
        $mock->shouldReceive('get')
            ->once()
            ->andReturn(collect([
                ['id' => 1, 'name' => 'John Doe', 'email' => 'johndoe@test'],
                ['id' => 2, 'name' => 'Mr Jhonny', 'email' => 'mrjhonny@test'],
            ]));
        $service = new UserService();
        $users = $service->getUserList();
        $this->assertCount(2, $users);
    }
}

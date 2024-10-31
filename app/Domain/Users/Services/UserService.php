<?php

namespace App\Domain\Users\Services;

use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Models\User;
use Illuminate\Support\Collection;

class UserService implements UserRepository
{
    public function getUserList(): Collection
    {
        return User::get();
    }
}

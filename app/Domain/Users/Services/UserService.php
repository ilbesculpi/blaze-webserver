<?php

namespace App\Domain\Users\Service;

use App\Domain\Users\Repositories;
use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserRepository
{
    public function getUserList(): Collection
    {
        return User::get();
    }
}

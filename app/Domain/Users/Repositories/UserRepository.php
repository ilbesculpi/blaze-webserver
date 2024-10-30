<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{

    public function getAllUsers(): Collection
    {
        return User::get();
    }
}

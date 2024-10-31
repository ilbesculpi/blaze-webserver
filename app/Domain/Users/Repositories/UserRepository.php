<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepository
{
    public function getUserList(): Collection;
}


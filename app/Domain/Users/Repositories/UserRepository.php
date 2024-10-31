<?php

namespace App\Domain\Users\Repositories;

use Illuminate\Support\Collection;
use App\Domain\Users\Models\User;

interface UserRepository
{
    public function getUserList(): Collection;
}

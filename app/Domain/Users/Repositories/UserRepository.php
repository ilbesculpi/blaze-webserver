<?php

namespace App\Domain\Users\Repositories;

use App\Domain\Users\Requests\CreateUserRequest;
use Illuminate\Support\Collection;
use App\Domain\Users\Models\User;

interface UserRepository
{
    public function getUserList(): Collection;
    public function createUser(CreateUserRequest $request): User;
}

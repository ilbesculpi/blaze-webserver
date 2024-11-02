<?php

namespace App\Domain\Users\Services;

use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Models\User;
use App\Domain\Users\Requests\CreateUserRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService implements UserRepository
{
    public function getUserList(): Collection
    {
        return User::get();
    }

    public function createUser(CreateUserRequest $request): User
    {
        return User::create([
            'id' => Str::ulid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
    }

}

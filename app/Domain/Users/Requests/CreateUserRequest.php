<?php

namespace App\Domain\Users\Requests;

final class CreateUserRequest
{

    readonly string $name;
    readonly string $password;
    readonly string $email;
    readonly string $role;

    public function __construct(string $name, string $email, string $password, string $role)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = "";
    }

}

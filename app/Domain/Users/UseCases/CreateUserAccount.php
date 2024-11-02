<?php

namespace App\Domain\Users\UseCases;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Models\User;

class CreateUserAccount
{

    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function execute($request): User
    {
        // TODO: validate request input
        $user = $this->userRepository->createUser($request);
        return $user;
    }

}

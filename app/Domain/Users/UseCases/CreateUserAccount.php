<?php

namespace App\Domain\Users\UseCases;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Models\User;

class CreateUserAccount
{

    public function __construct(protected UserRepository $repository)
    {
    }

    public function execute($request): User
    {
        // TODO: validate request input
        $user = $this->repository->createUser($request);
        return $user;
    }

}

<?php

namespace App\Infrastructure\Laravel\Http\Api;

use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UserRepository;
use App\Domain\Users\Requests\CreateUserRequest;
use App\Domain\Users\UseCases\CreateUserAccount;
use App\Infrastructure\Laravel\Exceptions\BadRequestException;
use App\Infrastructure\Laravel\Exceptions\NotAuthorizedException;
use App\Infrastructure\Laravel\Exceptions\NotImplementedException;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PDOException;

class UserController extends ApiController
{

    public function __construct(protected UserRepository $repository) {
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        return [
            'users' => $this->repository->getUserList()
        ];
    }

    /**
     * Create a new User account.
     */
    public function store(Request $request)
    {
        // if( !$request->user()->tokenCan('create_users') ) {
        //     throw new NotAuthorizedException();
        // }
        try {
            $request = new CreateUserRequest(
                $request->input('name'),
                $request->input('email'),
                $request->input('password'),
                $request->input('role'),
            );
            $useCase = new CreateUserAccount($this->repository);
            $user = $useCase->execute($request);
        }
        catch (BadRequestException $e) {
        }
        catch (NotAuthorizedException $e) {
        }
        catch (PDOException $e) {
        }

        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'role' => 'required',
        // ]);



        return [
            'user' => $user
        ];
    }

    /**
     * Retrieve a given user.
     */
    public function show(Request $request, User $user)
    {
        // Check if user can access the resource
        if( $request->user()->id !== $user->id && $request->user()->role !== 'sysadmin' ) {
            return response([
                'result' => false
            ], 403);
        }
        // Return User
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        throw new NotImplementedException();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        throw new NotImplementedException();
    }

}

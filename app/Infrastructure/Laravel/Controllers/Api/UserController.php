<?php

namespace App\Infrastructure\Laravel\Controllers\Api;

use App\Domain\Users\Models\User;
use App\Domain\Users\Repositories\UserRepository;
use App\Infrastructure\Laravel\Exceptions\NotAuthorizedException;
use App\Infrastructure\Laravel\Exceptions\NotImplementedException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends ApiController
{

    public function __construct(protected UserRepository $repository) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return [
            'users' => $this->repository->getUserList()
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( !$request->user()->tokenCan('create_users') ) {
            throw new NotAuthorizedException();
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create([
            'id' => Str::ulid(),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return [
            'user' => $user
        ];
    }

    /**
     * Display the specified resource.
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

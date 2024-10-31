<?php

namespace App\Infrastructure\Laravel\Exceptions;

class NotAuthorizedException extends ApiException
{

    public function render()
    {
        return response()->json([
            'result' => 'error',
            'message' => 'User Not Authorized',
        ], 401);
    }

}

<?php

namespace App\Infrastructure\Laravel\Exceptions;

class BadRequestException extends ApiException
{

    public function render()
    {
        return response()->json([
            'result' => 'error',
            'message' => 'Bad Request',
        ], 400);
    }

}

<?php

namespace App\Infrastructure\Laravel\Exceptions;

class NotFoundException extends ApiException
{

    public function render()
    {
        return response()->json([
            'result' => 'error',
            'message' => 'Resource Not Found X('
        ], status: 404);
    }

}

<?php

namespace App\Infraestructure\Laravel\Exceptions;

class NotImplementedException extends ApiException
{

    public function render()
    {
        return response()->json([
            'result' => 'error',
            'message' => 'Endpoint not implemented.'
        ], 501);
    }

}

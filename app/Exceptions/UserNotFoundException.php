<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class UserNotFoundException extends Exception
{
    protected $message = 'User not found';

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage()
        ], 400);
    }
}

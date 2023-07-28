<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ResetPasswordInvalidTokenException extends Exception
{
    protected $message = 'Invalid token provided to reset password';

    public function render(): JsonResponse
    {
        return response()->json([
            'error' => class_basename($this),
            'message' => $this->getMessage(),
        ], 400);
    }
}

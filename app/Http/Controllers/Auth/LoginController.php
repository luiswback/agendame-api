<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\InvalidAuthenticationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /**
     * @throws InvalidAuthenticationException
     */
    public function __invoke(LoginRequest $request): UserResource
    {
        Log::debug('aqui');
        $input = $request->validated();

        if (!Auth::attempt($input)) {
            //caso necessário pode-se passar como parâmetro uma mensagem personalizada
            throw new InvalidAuthenticationException();
        }
        $request->session()->regenerate();

        return new UserResource(auth()->user());
    }
}

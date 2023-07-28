<?php

namespace App\Http\Controllers\Auth;

use App\Events\ForgotPasswordTokenRequested;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /**
     * @throws UserNotFoundException
     */
    public function __invoke(ForgotPasswordRequest $request)
    {
        $input = $request->validated();

        $user = User::query()
            ->whereEmail($input['email'])
            ->first();

        if (!$user) {
            throw new UserNotFoundException();
        }

        $token = $user->resetPasswordTokens()->create([
            'token' => strtoupper(Str::random(6))
        ]);

        ForgotPasswordTokenRequested::dispatch($user, $token->token);
    }
}

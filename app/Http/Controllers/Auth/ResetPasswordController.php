<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ResetPasswordInvalidTokenException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Resources\User\UserResource;
use App\Models\UserPasswordResetToken;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    /**
     * @throws ResetPasswordInvalidTokenException
     */
    public function __invoke(ResetPasswordRequest $request)
    {

        $input = $request->validated();

        $token = UserPasswordResetToken::query()
            ->with('user')
            ->whereToken($input['token'])
            ->whereDate('created_at', '>', now()->subHours(24)->toDateString())
            ->first();

        if (!$token) {
            throw new ResetPasswordInvalidTokenException();
        }

        $user = $token->user;

        $user->password = bcrypt($input['password']);
        $user->save();

        $user->resetPasswordTokens()->delete();

        return new UserResource($user);

    }
}

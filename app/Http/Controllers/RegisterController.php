<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserRegistered;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register.
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        $user->sendEmailVerificationNotification();

        return $this->createdResponse(new UserRegistered($user));
    }

    /**
     * Email verification.
     */
    public function emailVerify(EmailVerificationRequest $request): JsonResponse
    {
        $user = $request->user();
        if (! hash_equals(sha1($user->email), $request->hash)) {
            return $this->forbiddenResponse([]);
        }
        if (! $user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            return $this->noContentResponse();
        }

        return $this->notFoundResponse([]);
    }
}

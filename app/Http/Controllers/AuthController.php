<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserAuthenticatedResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['logout']);
    }

    /**
     * Login.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => Lang::get('auth.failed'),
            ]);
        }

        return $this->okResponse(new UserAuthenticatedResource($user));
    }

    /**
     * Logout.
     */
    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();

        return $this->noContentResponse();
    }
}

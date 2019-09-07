<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthManager $authManager
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request, AuthManager $authManager): JsonResponse
    {
        $userProvider = $authManager->createUserProvider(config('auth.guards.api.provider'));
        $user         = $userProvider->retrieveByCredentials($request->all());

        if ($user && $userProvider->validateCredentials($user, $request->all())) {
            return response()->json(['token' => $user->api_token]);
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
}

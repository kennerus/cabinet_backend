<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Tokenizer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'email'     => $request->email,
            'name'      => $request->name,
            'password'  => \Hash::make($request->password),
            'api_token' => Tokenizer::generate()
        ]);

        return new JsonResponse(['token' => $user->api_token]);
    }
}

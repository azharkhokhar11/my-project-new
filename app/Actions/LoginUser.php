<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Http\Resources\UserResource;
use App\Http\Requests\LoginUserRequest;

class LoginUser
{
    public function handle(LoginUserRequest $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            throw new AuthenticationException();
        }

        $user = User::firstWhere('email', $request->email);
        $token = $user->createToken('access-token')->plainTextToken;

        $resource = new UserResource($user);
        $resource->token = $token;

        return $resource;
    }
}

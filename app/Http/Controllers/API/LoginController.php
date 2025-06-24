<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Actions\LoginUser;

class LoginController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginUserRequest $request, LoginUser $action)
    {
        return $action->handle($request);

        // $request->validated($request->all());

        // if(! Auth::attempt($request->only('email','password')))
        // {
        //     throw new AuthenticationException();
        // }

        // $user = User::firstWhere('email',$request->email);
        // $token = $user->createToken('access-token')->plainTextToken;
        // $resource = new UserResource($user);
        // $resource->token = $token;

        // return $resource;    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return new UserResource($request->user());
    }
}

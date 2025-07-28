<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\RegisterUserRequest;
use App\Services\UserService;

class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = $this->userService->registerUser($validated);
        if($user)
        {
            return new UserResource($user);
        }
        // $user = new User;
        // $user->first_name = $validated['first_name'];
        // $user->last_name = $validated['last_name'];
        // $user->email = $validated['email'];
        // $user->password = Hash::make($validated['password']);
        // $user->role = $validated['role'];
        // $user->save();
        // Auth::login($user);

        // return new UserResource($user);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

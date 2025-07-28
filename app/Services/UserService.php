<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $validateddata)
    {
        $user = $this->userRepository->createUser($validateddata);
        if($user)
        {
            return $user;
        }

        return null;
        
    }
}

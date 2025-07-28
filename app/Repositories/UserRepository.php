<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $userModel;
    /**
     * Create a new class instance.
     */
    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function createUser(array $validateddata)
    {
        return $this->userModel->create($validateddata);
    }
}

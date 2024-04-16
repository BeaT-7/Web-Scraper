<?php
namespace App\Repositories;

use App\Models\User;

class UsersRepository
{
    public function createUser($user){
        return User::create($user);
    }
}

<?php

namespace App\Http\Repositories;

use App\Models\User;
use Exception;
use PHPUnit\Event\Code\Throwable;

class UserRepository
{

    public function create($data)
    {
        $result = User::create($data);
        return $result;
    }

    public function getUserById(int $id)
    {
        return  User::find($id);
    }

    public function getByEmail(string $email)
    {
        return User::where('email',$email)->first();
    }
}

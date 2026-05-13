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

    public function getUserById($id)
    {
        return  User::find($id);
    }

    public function getByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    public function all($limit)
    {
        return User::orderByDesc('created_at')->paginate($limit);
    }

    public function update($id, $data)
    {
        return User::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }
}

<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use App\Models\Role;
use App\Models\StatusUser;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserService
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function userHeader()
    {
        $user = Auth::user();
        return [
            'name' => $user->name,
            'email' => $user->email,
            'is_authorized' => $user->is_authorized == 0 ? false : true,
            'roles' => $user->role->name,
            'status' => $user->statusUser->name,
        ];
    }

    public function loginUser($data)
    {
        $user =  $this->userRepository->getByEmail($data['email']);
        if (!$user) new Exception('error al iniciar sesión.');

        if (!Hash::check($data['password'], $user->password)) new Exception('Las contraseñas no coinciden');

        return $user;
    }
    public function registerUser($data)
    {
        $result =  $this->userRepository->getByEmail($data['email']);
        if ($result) new Exception('error usuario existente.');

        $payload = [
            'id' => (string) Uuid::uuid4(),
            'role_id' => Role::where('name', 'user')->first()->id,
            'status_user_id' => StatusUser::where('name', 'enabled')->first()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        $user = $this->userRepository->create($payload);
        if (!$user) new Exception('error al crear usuario');

        return $user;
    }
}

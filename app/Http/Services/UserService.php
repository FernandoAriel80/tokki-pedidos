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
        if (!$user) throw new Exception('error al iniciar sesión.');

        if (!Hash::check($data['password'], $user->password)) throw new Exception('Las contraseñas no coinciden');

        return $user;
    }
    public function registerUser($data)
    {
        $result =  $this->userRepository->getByEmail($data['email']);
        if ($result) throw new Exception('error usuario existente.');

        $payload = [
            'id' => (string) Uuid::uuid4(),
            'role_id' => Role::where('name', 'user')->first()->id,
            'status_user_id' => StatusUser::where('name', 'enabled')->first()->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ];

        $user = $this->userRepository->create($payload);
        if (!$user) throw new Exception('error al crear usuario');

        return $user;
    }

    public function allUsers()
    {
        $limit = 8;
        $users = $this->userRepository->all($limit);
        if (!$users) throw new Exception('Error al obtener los usuarios');
        return $users;
    }

    public function updateUser($id)
    {
        $resul = $this->userRepository->getUserById($id);

        if (!$resul) throw new Exception('Error al encontrar el usuario');

        $payload = [
            'is_authorized' => $resul->is_authorized == 0 ? 1 : 0,
        ];
        $user = $this->userRepository->update($id, $payload);

        if (!$user) throw new Exception('Error al actualizar un usuario');
        return $user;
    }

    public function deleteUser($id)
    {
        $resul = $this->userRepository->getUserById($id);

        if (!$resul) throw new Exception('Error al encontrar el usuario');

        $user = $this->userRepository->delete($id);
        if (!$user) throw new Exception('Error al eliminar el usuario');
        return $user;
    }

    public function changePassword($data)
    {
        $id = Auth::id();
        $result = $this->userRepository->getUserById($id);
        
        if (!$result) throw new Exception('Error al obtener usuario');
        
        
        if (!Hash::check($data['current_password'], $result->password)) throw new Exception('Las contraseñas no coinciden');
        
        $payload = [
            'password' => Hash::make($data['password']),
        ];

        $user = $this->userRepository->update($id, $payload);

        if (!$user) throw new Exception('Error al actualizar contraseña');

        return $user;
    }
}

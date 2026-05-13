<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        try {
            $user = $this->userService->userHeader();
            $users = $this->userService->allUsers();
            return view('pages.admin.dasboard', [
                'userAuth' => $user,
                'users' => $users,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al obtener acceso al admin: ')->withInput();
        }
    }

    public function update($id)
    {
        try {
            $this->userService->updateUser($id);
            return redirect()->route('dasboard')->with('success', 'Usuario actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar un usuario')->withInput();
        }
    }

    public function delete($id)
    {
        try {
            $this->userService->deleteUser($id);
            return redirect()->route('dasboard')->with('success', 'Usuario eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al aliminar usuario')->withInput();
        }
    }
}

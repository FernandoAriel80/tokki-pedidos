<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;

class PorfileController extends Controller
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

            return view('pages.porfile.porfile', [
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Error al cargar el perfil.')->withInput();
        }
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8',
        ], [

            'current_password.required' => 'La contraseña actual es obligatorio.',
            'current_password.min' => 'La contraseña actual debe tener al menos :min caracteres.',

            'password.required' => 'La nueva contraseña es obligatorio.',
            'password.min' => 'La nueva contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'Las nuevas contraseñas no coinciden.'
        ]);

        try {
            $this->userService->changePassword($validated);
            return redirect()->route('/')->with('success', 'Contrasela actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors('error', 'Error al cambiar contraseña.')->withInput();
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function login(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            $this->userService->loginUser($validated);

            $payload = [
                'email' => $validated['email'],
                'password' => $validated['password'],
            ];

            if (Auth::attempt($payload)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            return back()->withErrors(['email' => 'Error al iniciar sesión usuario.']);
        } catch (\Exception $th) {
            return back()->withErrors(['email' => 'Error al iniciar sesión usuario.']);

/*             return back()->withErrors([
                'error' => 'Ocurrió un error al procesar tu solicitud.'
            ])->withInput(); */
        }
    }
    public function register(Request $request)
    {
        try {
            $validated  = $request->validate([
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8',
            ]);

            $this->userService->registerUser($validated);

            $payload = [
                'email' => $validated['email'],
                'password' => $validated['password'],
            ];

            if (Auth::attempt($payload)) {
                $request->session()->regenerate();
                return redirect()->intended('/');
            }
            return back()->withErrors(['email' => 'Error al registrar usuario.']);
        } catch (\Exception $th) {
            return back()->withErrors([
                'error' => 'Ocurrió un error al procesar tu solicitud.'
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect('/login');
        } catch (\Exception $th) {
            return back()->withErrors([
                'error' => 'Ocurrió un error al procesar tu solicitud.'
            ])->withInput();
        }
    }
}

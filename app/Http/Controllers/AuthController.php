<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Mostrar el formulario de login
     */
    public function showLogin()
    {
        // Si ya está autenticado, redirigir al home
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('auth.login');
    }

    /**
     * Procesar el login
     */
    public function login(Request $request)
    {
        // Validar los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser válido',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        // Intentar autenticar
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            \Log::info('Usuario autenticado exitosamente: ' . $request->email);
            
            return redirect()->intended(route('home'))->with('success', 'Bienvenido al sistema');
        }

        \Log::warning('Intento de login fallido para: ' . $request->email);

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->except('password'));
    }

    /**
     * Cerrar sesión
     */
    public function logout(Request $request)
    {
        $userEmail = Auth::user()->email ?? 'Usuario desconocido';
        
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        \Log::info('Usuario cerró sesión: ' . $userEmail);
        
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente');
    }

    /**
     * Crear usuario de prueba (solo para desarrollo)
     */
    public function createTestUser()
    {
        // Solo permitir en desarrollo
        if (app()->environment('production')) {
            abort(403, 'No disponible en producción');
        }

        $user = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Administrador',
                'email' => 'admin@test.com',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Usuario de prueba creado',
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'created' => $user->wasRecentlyCreated ? 'Nuevo' : 'Ya existía'
            ]
        ]);
    }
}
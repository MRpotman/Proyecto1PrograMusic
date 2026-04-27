<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use App\Models\CarritoCompras;
use App\Models\ListaDeseos;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

   public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    $usuario = Usuario::where('email', $request->email)->first();

    if (!$usuario || !Hash::check($request->password, $usuario->password)) {
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->withInput();
    }

    session([
        'usuario_id'     => $usuario->usuarioID,
        'usuario_nombre' => $usuario->nombre,
        'usuario_email'  => $usuario->email,
        'usuario_rol'    => $usuario->rol,  
    ]);

    // Redirigir según rol
    if ($usuario->rol === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('productos.index');
}

public function register(Request $request)
{
    $request->validate([
        'nombre'   => 'required|string|max:255',
        'email'    => 'required|email|unique:usuarios,email',
        'password' => 'required|min:6|confirmed', // necesita password_confirmation
        'telefono' => 'nullable|string|max:20',
        'direccion'=> 'nullable|string|max:255',
    ]);

    $usuario = Usuario::create([
        'nombre'    => $request->nombre,
        'email'     => $request->email,
        'password'  => \Illuminate\Support\Facades\Hash::make($request->password),
        'telefono'  => $request->telefono,
        'direccion' => $request->direccion,
    ]);

    CarritoCompras::create([
        'usuarioID' => $usuario->usuarioID,
        'total'     => 0,
    ]);

    ListaDeseos::create([
        'usuarioID' => $usuario->usuarioID,
    ]);

    session([
        'usuario_id'     => $usuario->usuarioID,
        'usuario_nombre' => $usuario->nombre,
        'usuario_email'  => $usuario->email,
    ]);

    return redirect()->route('productos.index');
}

public function dashboard()
{
    if (session('usuario_rol') !== 'admin') {
        return redirect()->route('productos.index');
    }

    return view('admin.dashboard');
}
public function logout()
{
    session()->flush();
    return redirect()->route('login');
}
}
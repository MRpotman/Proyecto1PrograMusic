<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // LISTAR
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    // FORM CREAR
    public function create()
    {
        return view('usuarios.create');
    }

    // GUARDAR
   public function store(Request $request)
{
    $request->validate([
        'nombre'   => 'required|string|max:255',
        'email'    => 'required|email|unique:usuarios,email',
        'password' => 'required|string|min:6',
        'telefono' => 'nullable|string',
        'direccion'=> 'nullable|string'
    ]);

    Usuario::create([
        'nombre'   => $request->nombre,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'telefono' => $request->telefono,
        'direccion'=> $request->direccion,
        'rol'      => $request->rol ?? 'user',
    ]);

    return redirect()->route('usuarios.index')
                     ->with('success', 'Usuario creado correctamente');
}

    // MOSTRAR
    public function show($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // FORM EDITAR
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
{
    $usuario = Usuario::findOrFail($id);

    $request->validate([
        'nombre'     => 'required|string|max:255',
        'email'      => 'required|email|unique:usuarios,email,' . $id . ',usuarioID',
        'password' => 'nullable|string|min:6',
        'telefono'   => 'nullable|string',
        'direccion'  => 'nullable|string'
    ]);

    $datos = [
        'nombre'   => $request->nombre,
        'email'    => $request->email,
        'telefono' => $request->telefono,
        'direccion'=> $request->direccion,
        'rol'      => $request->rol ?? 'user',
    ];

    if ($request->filled('password')) {
    $datos['password'] = Hash::make($request->password);
    }

    $usuario->update($datos);

    return redirect()->route('usuarios.index')
                     ->with('success', 'Usuario actualizado correctamente');
}

    // ELIMINAR
    public function destroy($id)
    {
        Usuario::destroy($id);

        return redirect()->route('usuarios.index')
                         ->with('success', 'Usuario eliminado correctamente');
    }
}
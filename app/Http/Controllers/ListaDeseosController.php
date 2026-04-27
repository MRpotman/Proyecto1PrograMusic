<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ListaDeseos;
use App\Models\Usuario;

class ListaDeseosController extends Controller
{
    public function index()
    {
        $listas = ListaDeseos::with('usuario')->get();
        return view('lista-deseos.index', compact('listas'));
    }

    public function create()
    {
        $usuarios = Usuario::all();
        return view('lista-deseos.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuarioID' => 'required'
        ]);

        ListaDeseos::create([
            'usuarioID' => $request->usuarioID
        ]);

        return redirect()->route('lista-deseos.index')
            ->with('success', 'Lista de deseos creada');
    }

    public function show(string $id)
    {
        $lista = ListaDeseos::with(['usuario', 'items.producto'])
            ->findOrFail($id);

        return view('lista-deseos.show', compact('lista'));
    }

    public function edit(string $id)
    {
        $lista = ListaDeseos::findOrFail($id);
        $usuarios = Usuario::all();

        return view('lista-deseos.edit', compact('lista', 'usuarios'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'usuarioID' => 'required'
        ]);

        $lista = ListaDeseos::findOrFail($id);

        $lista->update([
            'usuarioID' => $request->usuarioID
        ]);

        return redirect()->route('lista-deseos.index')
            ->with('success', 'Lista actualizada');
    }

    public function destroy(string $id)
    {
        $lista = ListaDeseos::findOrFail($id);
        $lista->delete();

        return redirect()->route('lista-deseos.index')
            ->with('success', 'Lista eliminada');
    }

public function miLista()
{
    $usuarioID = session('usuario_id');

    $lista = ListaDeseos::with('items.producto')
                        ->where('usuarioID', $usuarioID)
                        ->first();

    $wishlistIDs = $lista ? $lista->items->pluck('productoID')->toArray() : [];

    return view('lista-deseos.show', compact('lista', 'wishlistIDs'));
}
}
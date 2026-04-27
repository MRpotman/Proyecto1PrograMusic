<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TipoProducto::query();

        // 🔎 SEARCH
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->buscar . '%');
        }

        // 🔽 ORDER
        if ($request->orden == 'asc') {
            $query->orderBy('nombre', 'asc');
        } elseif ($request->orden == 'desc') {
            $query->orderBy('nombre', 'desc');
        } else {
            $query->orderBy('nombre', 'asc'); // default
        }

        $tipos = $query->get();

        return view('tipos.index', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        TipoProducto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('tipos.index')
                         ->with('success', 'Tipo de producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tipo = TipoProducto::findOrFail($id);
        return view('tipos.show', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $tipo = TipoProducto::findOrFail($id);

        $tipo->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('tipos.index')
                         ->with('success', 'Tipo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tipo = TipoProducto::findOrFail($id);
        $tipo->delete();

        return redirect()->route('tipos.index')
                         ->with('success', 'Tipo eliminado correctamente');
    }
}
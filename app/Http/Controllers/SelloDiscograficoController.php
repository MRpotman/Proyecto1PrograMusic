<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SelloDiscografico;

class SelloDiscograficoController extends Controller
{
    public function index(Request $request)
    {
        $query = SelloDiscografico::query();

        // 🔎 SEARCH
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // 🔽 ORDER
        if ($request->orden == 'asc') {
            $query->orderBy('nombre', 'asc');
        } elseif ($request->orden == 'desc') {
            $query->orderBy('nombre', 'desc');
        } else {
            $query->orderBy('nombre', 'asc');
        }

        $sellos = $query->get();

        return view('sellos.index', compact('sellos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        SelloDiscografico::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('sellos.index')
                         ->with('success', 'Sello creado correctamente');
    }

    public function show(string $id)
    {
        $sello = SelloDiscografico::findOrFail($id);
        return view('sellos.show', compact('sello'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $sello = SelloDiscografico::findOrFail($id);

        $sello->update([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('sellos.index')
                         ->with('success', 'Sello actualizado correctamente');
    }

    public function destroy(string $id)
    {
        $sello = SelloDiscografico::findOrFail($id);
        $sello->delete();

        return redirect()->route('sellos.index')
                         ->with('success', 'Sello eliminado');
    }
}
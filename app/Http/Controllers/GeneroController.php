<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;

class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $query = Genero::query();

            // 🔎 BUSCAR
            if ($request->filled('buscar')) {
                $query->where('nombre', 'like', '%' . $request->buscar . '%');
            }

            // 🔽 ORDENAR
            if ($request->orden == 'asc') {
                $query->orderBy('nombre', 'asc');
            } elseif ($request->orden == 'desc') {
                $query->orderBy('nombre', 'desc');
            } else {
                $query->orderBy('nombre', 'asc'); // default
            }

            $generos = $query->get();

            return view('generos.index', compact('generos'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('generos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Genero::create($request->all());

        return redirect()->route('generos.index')
                         ->with('success', 'Género creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $genero = Genero::findOrFail($id);
        return view('generos.show', compact('genero'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genero = Genero::findOrFail($id);
        return view('generos.edit', compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
            $request->validate([
                'nombre' => 'required|string|max:255'
            ]);

            $genero = Genero::findOrFail($id);

            $genero->update([
                'nombre' => $request->nombre
            ]);

            return redirect()->route('generos.index')
                            ->with('success', 'Genre updated successfully');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $genero = Genero::findOrFail($id);
        $genero->delete();

        return redirect()->route('generos.index')
                         ->with('success', 'Género eliminado');
    }
}

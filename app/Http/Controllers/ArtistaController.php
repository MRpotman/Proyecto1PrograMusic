<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artista;
use App\Models\SelloDiscografico;

class ArtistaController extends Controller
{
    // LISTAR + FILTROS
    public function index(Request $request)
    {
        $query = Artista::with('selloDiscografico');

        // 🔎 BUSCAR
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        // 🎧 FILTRO POR SELLO
        if ($request->filled('sello')) {
            $query->where('selloDiscograficoID', $request->sello);
        }

        // 🔽 ORDEN
        if ($request->orden == 'asc') {
            $query->orderBy('nombre', 'asc');
        } elseif ($request->orden == 'desc') {
            $query->orderBy('nombre', 'desc');
        } else {
            $query->orderBy('nombre', 'asc');
        }

        $artistas = $query->get();
        $sellos = SelloDiscografico::all(); // para el select del filtro

        return view('artistas.index', compact('artistas', 'sellos'));
    }

    // FORM CREAR
    public function create()
    {
        $sellos = SelloDiscografico::all();
        return view('artistas.create', compact('sellos'));
    }

    // GUARDAR
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'selloDiscograficoID' => 'required|integer'
        ]);

        Artista::create([
            'nombre' => $request->nombre,
            'nacionalidad' => $request->nacionalidad,
            'selloDiscograficoID' => $request->selloDiscograficoID
        ]);

        return redirect()->route('artistas.index')
            ->with('success', 'Artista creado correctamente');
    }

    // MOSTRAR
    public function show($id)
    {
        $artista = Artista::with('selloDiscografico')->findOrFail($id);
        return view('artistas.show', compact('artista'));
    }

    // FORM EDITAR
    public function edit($id)
    {
        $artista = Artista::findOrFail($id);
        $sellos = SelloDiscografico::all();

        return view('artistas.edit', compact('artista', 'sellos'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $artista = Artista::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'selloDiscograficoID' => 'required|integer'
        ]);

        $artista->update([
            'nombre' => $request->nombre,
            'nacionalidad' => $request->nacionalidad,
            'selloDiscograficoID' => $request->selloDiscograficoID
        ]);

        return redirect()->route('artistas.index')
            ->with('success', 'Artista actualizado correctamente');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Artista::destroy($id);

        return redirect()->route('artistas.index')
            ->with('success', 'Artista eliminado correctamente');
    }
}
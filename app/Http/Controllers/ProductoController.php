<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Artista;
use App\Models\Genero;
use App\Models\TipoProducto;

class ProductoController extends Controller
{
    public function index(Request $request)
{
    $query = Producto::with(['artista', 'genero', 'tipoProducto']);

    // 🔍 BUSCAR
    if ($request->buscar) {
        $query->where(function ($q) use ($request) {
            $q->where('nombre', 'like', "%{$request->buscar}%")
              ->orWhere('album', 'like', "%{$request->buscar}%");
        });
    }

    // 🔤 ORDEN
    if ($request->orden) {
        $query->orderBy('nombre', $request->orden);
    }

    // 🎤 FILTRO ARTISTA
    if ($request->artista) {
        $query->where('artistaID', $request->artista);
    }

    // 🎼 FILTRO GÉNERO
    if ($request->genero) {
        $query->where('generoID', $request->genero);
    }

    // 💰 PRECIO
    if ($request->min) {
        $query->where('precio', '>=', $request->min);
    }

    if ($request->max) {
        $query->where('precio', '<=', $request->max);
    }

    $productos = $query->paginate(12);

    $artistas = Artista::all();
    $generos = Genero::all();
    $tipos = TipoProducto::all();

    // 🔥 WISHLIST (AQUÍ ES DONDE VA)
    $wishlistIDs = [];

    $usuarioID = session('usuario_id');

    if ($usuarioID) {
        $lista = \App\Models\ListaDeseos::with('items')
            ->where('usuarioID', $usuarioID)
            ->first();

        if ($lista && $lista->items) {
            $wishlistIDs = $lista->items->pluck('productoID')->toArray();
        }
    }

    // 🔥 IMPORTANTE: agregar wishlistIDs
    return view('productos.index', compact(
        'productos',
        'artistas',
        'generos',
        'tipos',
        'wishlistIDs'
    ));
}

    public function create()
    {
        $artistas = Artista::all();
        $generos = Genero::all();
        $tipos = TipoProducto::all();

        return view('productos.create', compact('artistas', 'generos', 'tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'album' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'fechaLanzamiento' => 'required|date',
            'artistaID' => 'required',
            'generoID' => 'required',
            'tipoProductoID' => 'required',
            'imagen' => 'nullable|url',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'album' => $request->album,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'fechaLanzamiento' => $request->fechaLanzamiento,
            'artistaID' => $request->artistaID,
            'generoID' => $request->generoID,
            'tipoProductoID' => $request->tipoProductoID,
            'imagen' => $request->imagen,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado');
    }

    public function show(string $id)
    {
        $producto = Producto::with(['artista', 'genero', 'tipoProducto'])
            ->findOrFail($id);

        return view('productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);

        $artistas = Artista::all();
        $generos = Genero::all();
        $tipos = TipoProducto::all();

        return view('productos.edit', compact('producto', 'artistas', 'generos', 'tipos'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'album' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'fechaLanzamiento' => 'required|date',
            'imagen' => 'nullable|url',
            'artistaID' => 'required',
            'generoID' => 'required',
            'tipoProductoID' => 'required',
        ]);

        $producto = Producto::findOrFail($id);

        $producto->update([
            'nombre' => $request->nombre,
            'album' => $request->album,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'fechaLanzamiento' => $request->fechaLanzamiento,
            'artistaID' => $request->artistaID,
            'generoID' => $request->generoID,
            'tipoProductoID' => $request->tipoProductoID,
            'imagen' => $request->imagen,
        ]);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado');
    }
}
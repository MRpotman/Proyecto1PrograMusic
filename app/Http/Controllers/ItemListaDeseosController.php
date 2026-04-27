<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemListaDeseos;
use App\Models\ListaDeseos;
use App\Models\Producto;

class ItemListaDeseosController extends Controller
{
    public function index()
    {
        $items = ItemListaDeseos::with(['listaDeseos', 'producto'])->get();
        return view('lista-deseos-items.index', compact('items'));
    }

    public function create()
    {
        $listas = ListaDeseos::all();
        $productos = Producto::all();

        return view('lista-deseos-items.create', compact('listas', 'productos'));
    }

    public function store(Request $request)
    {
        ItemListaDeseos::create($request->all());

        return redirect()->route('lista-deseos-items.index')
            ->with('success', 'Item agregado a lista de deseos');
    }

    public function show(string $id)
    {
        $item = ItemListaDeseos::with(['listaDeseos', 'producto'])->findOrFail($id);
        return view('lista-deseos-items.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = ItemListaDeseos::findOrFail($id);
        $listas = ListaDeseos::all();
        $productos = Producto::all();

        return view('lista-deseos-items.edit', compact('item', 'listas', 'productos'));
    }

    public function update(Request $request, string $id)
    {
        $item = ItemListaDeseos::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('lista-deseos-items.index')
            ->with('success', 'Item actualizado');
    }

    public function destroy(string $id)
    {
        $item = ItemListaDeseos::findOrFail($id);
        $item->delete();

            return redirect()->back()
        ->with('success', 'Item eliminado');
    }

    public function addToWishlist(Request $request)
{
    $productoID = $request->productoID;
    $usuarioID  = session('usuario_id');

    $lista = ListaDeseos::where('usuarioID', $usuarioID)->first();

    if (!$lista) {
        return back()->with('error', 'No wishlist found for this user.');
    }

    $item = ItemListaDeseos::where('listaDeseosID', $lista->listaDeseosID)
                            ->where('productoID', $productoID)
                            ->first();

    if ($item) {
        $item->delete();
        return back()->with('info', 'Removed from wishlist');
    }

    ItemListaDeseos::create([
        'listaDeseosID' => $lista->listaDeseosID,
        'productoID'    => $productoID,
    ]);

    return back()->with('success', 'Added to wishlist');
}

}
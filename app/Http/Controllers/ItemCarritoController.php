<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemCarrito;
use App\Models\CarritoCompras;
use App\Models\Producto;

class ItemCarritoController extends Controller
{
    public function index()
    {
        $items = ItemCarrito::with(['carrito', 'producto'])->get();
        return view('carrito-items.index', compact('items'));
    }

    public function create()
    {
        $carritos = CarritoCompras::with('usuario')->get();
        $productos = Producto::all();

        return view('carrito-items.create', compact('carritos', 'productos'));
    }

    public function addToCart(Request $request)
    {
        $productoID = $request->productoID;
        $usuarioID  = session('usuario_id');

        $carrito = CarritoCompras::where('usuarioID', $usuarioID)->first();

        if (!$carrito) {
            return back()->with('error', 'No cart found for this user.');
        }

        $producto = Producto::findOrFail($productoID); // <-- esta linea faltaba

        $item = ItemCarrito::where('carritoID', $carrito->carritoID)
                        ->where('productoID', $productoID)
                        ->first();

        if ($item) {
            $item->increment('cantidad');
        } else {
            ItemCarrito::create([
                'carritoID'      => $carrito->carritoID,
                'productoID'     => $productoID,
                'cantidad'       => 1,
                'precioUnitario' => $producto->precio,
            ]);
        }

        $carrito->load('items.producto');
        $total = $carrito->items->sum(fn($i) => $i->cantidad * $i->producto->precio);
        $carrito->update(['total' => $total]);

        return back()->with('success', 'Product added to cart!');
    }
    
    public function show(string $id)
    {
        $item = ItemCarrito::with(['carrito', 'producto'])->findOrFail($id);
        return view('carrito-items.show', compact('item'));
    }

    public function edit(string $id)
    {
        $item = ItemCarrito::findOrFail($id);
        $carritos = CarritoCompras::all();
        $productos = Producto::all();

        return view('carrito-items.edit', compact('item', 'carritos', 'productos'));
    }

    public function update(Request $request, string $id)
    {
        $item = ItemCarrito::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('carrito-items.index')
            ->with('success', 'Item actualizado');
    }

    public function destroy(string $id)
    {
        $item = ItemCarrito::findOrFail($id);
        $item->delete();

        return redirect()->route('carrito.show')
            ->with('success', 'Producto eliminado del carrito');
    }
}
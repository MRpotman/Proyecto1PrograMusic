@extends('layouts.app')
@section('title', 'My Cart')

@section('content')
<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="fw-bold mb-4">My Cart</h2>

    @if(!$carrito || $carrito->items->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size:3rem;"></i>
            <p class="mt-3 text-muted">Your cart is empty.</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Browse Products</a>
        </div>
    @else

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrito->items as $item)
                    <tr>
                        <td class="d-flex align-items-center gap-3">
                            <img src="{{ $item->producto->imagen ?? 'https://via.placeholder.com/60' }}"
                                 width="60" height="60"
                                 style="object-fit:cover; border-radius:8px;">
                            <div>
                                <div class="fw-bold">{{ $item->producto->nombre }}</div>
                                <small class="text-muted">{{ $item->producto->album }}</small>
                            </div>
                        </td>
                        <td>${{ number_format($item->precioUnitario, 2) }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->cantidad * $item->precioUnitario, 2) }}</td>
                        <td>
                            <form action="{{ route('carrito-items.destroy', $item->itemCarritoID) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end fw-bold fs-5">Total:</td>
                        <td colspan="2" class="fw-bold fs-5">${{ number_format($carrito->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('checkout') }}" class="btn btn-primary px-5">
                <i class="bi bi-credit-card"></i> Checkout
            </a>
        </div>

    @endif
</div>
@endsection
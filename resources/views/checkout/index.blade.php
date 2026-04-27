@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="container py-5" style="max-width: 700px;">

    <h2 class="fw-bold mb-1">Checkout</h2>
    <p class="text-muted mb-4">Review your order before confirming</p>

    <!-- ORDER SUMMARY -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold">
            Order Summary
        </div>
        <div class="card-body p-0">
            <table class="table mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carrito->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item->producto->imagen ?? 'https://via.placeholder.com/50' }}"
                                     width="50" height="50"
                                     style="object-fit:cover; border-radius:8px;">
                                <div>
                                    <div class="fw-semibold">{{ $item->producto->nombre }}</div>
                                    <small class="text-muted">${{ number_format($item->precioUnitario, 2) }} each</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">{{ $item->cantidad }}</td>
                        <td class="text-end">${{ number_format($item->cantidad * $item->precioUnitario, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <td colspan="2" class="text-end fw-bold fs-5">Total</td>
                        <td class="text-end fw-bold fs-5">${{ number_format($carrito->total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- DELIVERY INFO -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-dark text-white fw-semibold">
            Delivery Information
        </div>
        <div class="card-body">
            <p class="mb-1"><i class="bi bi-person me-2"></i><strong>{{ session('usuario_nombre') }}</strong></p>
            <p class="mb-1"><i class="bi bi-envelope me-2"></i>{{ session('usuario_email') }}</p>
        </div>
    </div>

    <!-- ACTIONS -->
    <div class="d-flex justify-content-between align-items-center">

        <a href="{{ route('carrito.show') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Cart
        </a>

        <form action="{{ route('checkout.confirmar') }}" method="POST">
            @csrf
            <button class="btn btn-primary px-5">
                <i class="bi bi-check-circle me-1"></i> Confirm Order
            </button>
        </form>

    </div>

</div>
@endsection
@extends('layouts.app')
@section('title', 'My Wishlist')

@section('content')
<div class="container py-5">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <h2 class="fw-bold mb-4">My Wishlist</h2>

    @if(!$lista || $lista->items->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-heart" style="font-size:3rem;"></i>
            <p class="mt-3 text-muted">Your wishlist is empty.</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary">Browse Products</a>
        </div>
    @else

        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Date Added</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lista->items as $item)
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

                        <td>{{ $item->fechaAgregado }}</td>

                        <td class="d-flex gap-2">
                            {{-- Eliminar --}}
                            <form action="{{ route('lista-deseos-items.destroy', $item->itemListaID) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            {{-- (Opcional) Mover al carrito --}}
                            <form action="{{ route('wishlist.moveToCart', $item->itemListaID) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-cart"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @endif
</div>
@endsection
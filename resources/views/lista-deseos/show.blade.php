@extends('layouts.app')
@section('title', 'My Wishlist')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold mb-4">My Wishlist</h2>

    {{-- Info de la lista --}}
    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-wrap">
                <div>
                    <p class="mb-1"><strong>User:</strong> {{ $lista->usuario->nombre }}</p>
                    <p class="mb-0 text-muted"><strong>Created:</strong> {{ $lista->fechaCreacion }}</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-dark fs-6">
                        {{ $lista->items->count() }} items
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Lista de productos --}}
    @if($lista->items->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-heart" style="font-size:3rem;"></i>
            <p class="mt-3 text-muted">Your wishlist is empty.</p>
            <a href="{{ route('productos.index') }}" class="btn btn-primary">
                Browse Products
            </a>
        </div>
    @else

        <div class="row g-4">
            @foreach($lista->items as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">

                        {{-- Imagen --}}
                        <img src="{{ $item->producto->imagen ?? 'https://via.placeholder.com/300' }}"
                             class="card-img-top"
                             style="height:200px; object-fit:cover;">

                        <div class="card-body d-flex flex-column">

                            {{-- Nombre --}}
                            <h5 class="card-title fw-bold">
                                {{ $item->producto->nombre }}
                            </h5>

                            {{-- Album --}}
                            <p class="text-muted mb-2">
                                {{ $item->producto->album }}
                            </p>

                            {{-- Precio --}}
                            <p class="fw-bold fs-5 mb-3">
                                ₡{{ number_format($item->producto->precio, 2) }}
                            </p>

                            {{-- Botones --}}
                            <div class="mt-auto d-flex gap-2">

                                {{-- Eliminar --}}
                                <form action="{{ route('lista-deseos-items.destroy', $item->itemListaID) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger w-100">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                                {{-- Agregar al carrito --}}
                                <form action="{{ route('carrito.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="productoID" value="{{ $item->producto->productoID }}">
                                    <button class="btn btn-primary w-100">
                                        <i class="bi bi-cart"></i>
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @endif

</div>
@endsection
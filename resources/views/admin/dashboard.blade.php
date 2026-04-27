@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-5">

    <div class="mb-5">
        <h2 class="fw-bold">Admin Dashboard</h2>
        <p class="text-muted">Welcome back, {{ session('usuario_nombre') }}</p>
    </div>

    <!-- STATS -->
    <div class="row g-4 mb-5">

        <div class="col-6 col-md-3">
            <div class="card text-center shadow-sm border-0 p-3">
                <i class="bi bi-box-seam" style="font-size:2rem;"></i>
                <h3 class="fw-bold mt-2">{{ \App\Models\Producto::count() }}</h3>
                <small class="text-muted">Products</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center shadow-sm border-0 p-3">
                <i class="bi bi-people" style="font-size:2rem;"></i>
                <h3 class="fw-bold mt-2">{{ \App\Models\Usuario::count() }}</h3>
                <small class="text-muted">Users</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center shadow-sm border-0 p-3">
                <i class="bi bi-music-note-list" style="font-size:2rem;"></i>
                <h3 class="fw-bold mt-2">{{ \App\Models\Artista::count() }}</h3>
                <small class="text-muted">Artists</small>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center shadow-sm border-0 p-3">
                <i class="bi bi-tags" style="font-size:2rem;"></i>
                <h3 class="fw-bold mt-2">{{ \App\Models\Genero::count() }}</h3>
                <small class="text-muted">Genres</small>
            </div>
        </div>

    </div>

    <!-- QUICK ACCESS -->
    <h5 class="fw-semibold mb-3">Quick Access</h5>

    <div class="row g-3">

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('productos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-vinyl" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Products</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('usuarios.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-people" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Users</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('artistas.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-music-note-beamed" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Artists</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('generos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-tags" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Genres</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('tipos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-grid" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Product Types</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('sellos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-building" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Record Labels</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('carrito-compras.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-cart3" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Carts</p>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ route('lista-deseos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 p-4 text-center h-100">
                    <i class="bi bi-heart" style="font-size:2rem;"></i>
                    <p class="mt-2 mb-0 fw-semibold">Wishlists</p>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection
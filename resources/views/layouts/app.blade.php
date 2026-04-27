<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Hikari Shop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container-fluid">

    <!-- Logo -->
    <a class="navbar-brand me-auto" href="{{ url('/') }}">
        Hikari's Records
    </a>

    <!-- OFFCANVAS -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar">

      <div class="offcanvas-header">
        <h5 class="offcanvas-title">Hikari's Records</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
      </div>

      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">

          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="{{ url('/') }}">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="{{ route('about') }}">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="{{ route('productos.index') }}">Products</a>
          </li>

          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="{{ route('wishlist.show') }}">Wishlist</a>
          </li>

          <!-- Category Dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
              Category
            </a>
            <ul class="dropdown-menu">
              @foreach(\App\Models\Genero::all() as $g)
                <li>
                  <a class="dropdown-item"
                     href="{{ route('productos.index', ['genero' => $g->generoID]) }}">
                    {{ $g->nombre }}
                  </a>
                </li>
              @endforeach
            </ul>
          </li>

        </ul>
      </div>
    </div>

    <!-- CARRITO + USUARIO -->
    <div class="d-flex align-items-center gap-3 me-3">

        @if(session('usuario_id'))

            <!-- CARRITO CON CONTADOR -->
            @php
                $carritoNav = \App\Models\CarritoCompras::with('items')
                              ->where('usuarioID', session('usuario_id'))
                              ->first();
                $countNav = $carritoNav ? $carritoNav->items->sum('cantidad') : 0;
            @endphp

            <a href="{{ route('carrito.show') }}"
               class="btn user-button d-flex align-items-center gap-2 position-relative">
                <i class="bi bi-cart3"></i>
                Cart
                @if($countNav > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $countNav }}
                    </span>
                @endif
            </a>

            <!-- USUARIO DROPDOWN -->
            <div class="dropdown">
                <button class="btn user-button dropdown-toggle d-flex align-items-center gap-2"
                        data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i>
                    {{ session('usuario_nombre') }}
                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li class="px-3 py-1">
                        <small class="text-muted">{{ session('usuario_email') }}</small>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    {{-- ADMIN DASHBOARD LINK --}}
                    @if(session('usuario_rol') === 'admin')
                        <li>
                            <a class="dropdown-item text-dark fw-semibold" href="{{ route('admin.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Admin Dashboard
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @endif

                    <li>
                        <a class="dropdown-item" href="{{ route('carrito.show') }}">
                            <i class="bi bi-cart3 me-2"></i> My Cart
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="{{ route('wishlist.show') }}">
                          <i class="bi bi-heart me-2"></i> Wishlist
                      </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>

        @else
            <a href="{{ route('login') }}" class="btn user-button">
                <i class="bi bi-person"></i> Sign In
            </a>
        @endif

    </div>

    <!-- BOTÓN RESPONSIVE -->
    <button class="navbar-toggler" type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

  </div>
</nav>

<div style="margin-top: 100px;"></div>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
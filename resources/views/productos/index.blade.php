@extends('layouts.app')

@section('title', 'Products')

@section('content')

<!-- ================= HEADER (FILTERS + CREATE INLINE) ================= -->
<div class="container py-4">

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('info'))
    <div class="alert alert-info">{{ session('info') }}</div>
  @endif

  <form method="GET" action="{{ route('productos.index') }}">
    <div class="row g-2 align-items-center">

      <div class="col-md-3">
        <input type="text" name="buscar" value="{{ request('buscar') }}"
               class="form-control" placeholder="Search product...">
      </div>

      <div class="col-md-2">
        <select name="orden" class="form-control">
          <option value="">Sort</option>
          <option value="asc" {{ request('orden') == 'asc' ? 'selected' : '' }}>A - Z</option>
          <option value="desc" {{ request('orden') == 'desc' ? 'selected' : '' }}>Z - A</option>
        </select>
      </div>

      <div class="col-md-2">
        <select name="artista" class="form-control">
          <option value="">Artist</option>
          @foreach($artistas as $a)
            <option value="{{ $a->artistaID }}" {{ request('artista') == $a->artistaID ? 'selected' : '' }}>
              {{ $a->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-2">
        <select name="genero" class="form-control">
          <option value="">Genre</option>
          @foreach($generos as $g)
            <option value="{{ $g->generoID }}" {{ request('genero') == $g->generoID ? 'selected' : '' }}>
              {{ $g->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-primary w-50">Filter</button>

        @if(session('usuario_rol') === 'admin')
          <button type="button" class="btn btn-dark w-50"
                  data-bs-toggle="modal" data-bs-target="#createProductModal">
            + Create
          </button>
        @endif
      </div>

    </div>
  </form>

</div>

<!-- ================= PRODUCTS GRID ================= -->
<div class="container py-3">
  <div class="row g-4">

    @forelse($productos as $p)

      @php
        $placeholder = 'https://via.placeholder.com/400x400?text=No+Image';
        $imgSrc = (!empty($p->imagen) && filter_var($p->imagen, FILTER_VALIDATE_URL))
                  ? $p->imagen
                  : $placeholder;
      @endphp

      <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">

        <div class="card w-100 shadow-sm position-relative">

          {{-- ❤️ CORAZÓN TOGGLE --}}
          <form action="{{ route('wishlist.add') }}" method="POST"
                style="position:absolute; top:10px; right:10px; z-index:10;">
            @csrf
            <input type="hidden" name="productoID" value="{{ $p->productoID }}">

            <button type="submit" class="btn btn-light rounded-circle shadow-sm"
                    style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;">
              <i class="bi 
                {{ in_array($p->productoID, $wishlistIDs) 
                    ? 'bi-heart-fill text-danger' 
                    : 'bi-heart text-dark' }}">
              </i>
            </button>
          </form>

          {{-- Imagen --}}
          <img src="{{ $imgSrc }}" class="card-img-top"
               style="height:220px; object-fit:cover;">

          <div class="card-body text-center d-flex flex-column">

            <h5>{{ $p->nombre }}</h5>
            <p class="text-muted">{{ $p->album }}</p>
            <p class="fw-bold">${{ $p->precio }}</p>

            <div class="mt-auto d-flex gap-2 justify-content-center flex-wrap">

              {{-- VER --}}
              <button class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewProduct{{ $p->productoID }}">
                View
              </button>

              @if(session('usuario_rol') === 'admin')

                <button class="btn btn-outline-secondary btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#editProduct{{ $p->productoID }}">
                  Edit
                </button>

              @else

                {{-- ADD TO CART --}}
                <form action="{{ route('carrito.add') }}" method="POST">
                  @csrf
                  <input type="hidden" name="productoID" value="{{ $p->productoID }}">
                  <button class="btn btn-primary btn-sm">
                    <i class="bi bi-cart-plus"></i> Add
                  </button>
                </form>

              @endif

            </div>

          </div>
        </div>

      </div>

      <!-- ================= VIEW MODAL ================= -->
      <div class="modal fade" id="viewProduct{{ $p->productoID }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content overflow-hidden">
            <div class="row g-0">

              <div class="col-md-6"
                   style="background:url('{{ $imgSrc }}') center/cover no-repeat; min-height:400px;">
              </div>

              <div class="col-md-6 p-4 d-flex flex-column justify-content-center">

                <h3 class="mb-3">{{ $p->nombre }}</h3>
                <p><strong>Album:</strong> {{ $p->album }}</p>
                <p><strong>Price:</strong> ${{ $p->precio }}</p>
                <p><strong>Stock:</strong> {{ $p->stock }}</p>
                <p><strong>Artist:</strong> {{ $p->artista->nombre ?? 'N/A' }}</p>
                <p><strong>Genre:</strong> {{ $p->genero->nombre ?? 'N/A' }}</p>
                <p><strong>Type:</strong> {{ $p->tipoProducto->nombre ?? 'N/A' }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">

                  <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                  @if(session('usuario_rol') === 'admin')
                    <form action="{{ route('productos.destroy', $p->productoID) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger"
                              onclick="return confirm('Delete this product?')">
                        Delete
                      </button>
                    </form>
                  @else
                    <div class="d-flex gap-2">
                      <form action="{{ route('carrito.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="productoID" value="{{ $p->productoID }}">
                        <button class="btn btn-primary btn-sm">
                          <i class="bi bi-cart-plus"></i> Add to Cart
                        </button>
                      </form>

                      <form action="{{ route('wishlist.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="productoID" value="{{ $p->productoID }}">
                        <button class="btn btn-outline-danger btn-sm">
                          <i class="bi bi-heart"></i> Wishlist
                        </button>
                      </form>
                    </div>
                  @endif

                </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <!-- ================= EDIT MODAL (INSIDE LOOP - FIX) ================= -->
      @if(session('usuario_rol') === 'admin')
      <div class="modal fade" id="editProduct{{ $p->productoID }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5>Edit Product</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="{{ route('productos.update', $p->productoID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                  <label>Name</label>
                  <input type="text" name="nombre" class="form-control" value="{{ $p->nombre }}" required>
                </div>

                <div class="mb-2">
                  <label>Album</label>
                  <input type="text" name="album" class="form-control" value="{{ $p->album }}">
                </div>

                <div class="row g-2 mb-2">
                  <div class="col-md-6">
                    <label>Price</label>
                    <input type="number" step="0.01" name="precio" class="form-control" value="{{ $p->precio }}">
                  </div>
                  <div class="col-md-6">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" value="{{ $p->stock }}">
                  </div>
                </div>

                <div class="row g-2 mb-2">
                  <div class="col-md-6">
                    <label>Release Date</label>
                    <input type="date" name="fechaLanzamiento" class="form-control"
                           value="{{ $p->fechaLanzamiento ? \Carbon\Carbon::parse($p->fechaLanzamiento)->format('Y-m-d') : '' }}">
                  </div>
                  <div class="col-md-6">
                    <label>Image URL</label>
                    <input type="text" name="imagen" class="form-control" value="{{ $p->imagen }}">
                  </div>
                </div>

                <div class="row g-2 mb-2">
                  <div class="col-md-6">
                    <label>Artist</label>
                    <select name="artistaID" class="form-control">
                      @foreach($artistas as $a)
                        <option value="{{ $a->artistaID }}"
                          {{ $p->artistaID == $a->artistaID ? 'selected' : '' }}>
                          {{ $a->nombre }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label>Genre</label>
                    <select name="generoID" class="form-control">
                      @foreach($generos as $g)
                        <option value="{{ $g->generoID }}"
                          {{ $p->generoID == $g->generoID ? 'selected' : '' }}>
                          {{ $g->nombre }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="mb-3">
                  <label>Type</label>
                  <select name="tipoProductoID" class="form-control">
                    @foreach($tipos as $t)
                      <option value="{{ $t->tipoProductoID }}"
                        {{ $p->tipoProductoID == $t->tipoProductoID ? 'selected' : '' }}>
                        {{ $t->nombre }}
                      </option>
                    @endforeach
                  </select>
                </div>

                <button class="btn btn-primary w-100">Update Product</button>

              </form>
            </div>
          </div>
        </div>
      </div>
      @endif
      <!-- ================= END EDIT MODAL ================= -->

    @empty
      <div class="col-12 text-center">
        <p>No products found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- ================= CREATE MODAL ================= -->
<div class="modal fade" id="createProductModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Create Product</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('productos.store') }}" method="POST">
          @csrf

          <div class="mb-2">
            <input class="form-control" name="nombre" placeholder="Name">
          </div>
          <div class="mb-2">
            <input class="form-control" name="album" placeholder="Album">
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-6">
              <input class="form-control" name="precio" placeholder="Price">
            </div>
            <div class="col-md-6">
              <input class="form-control" name="stock" placeholder="Stock">
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-6">
              <input type="date" class="form-control" name="fechaLanzamiento">
            </div>
            <div class="col-md-6">
              <input class="form-control" name="imagen" placeholder="Image URL">
            </div>
          </div>

          <div class="row g-2 mb-2">
            <div class="col-md-6">
              <select class="form-control" name="artistaID">
                @foreach($artistas as $a)
                  <option value="{{ $a->artistaID }}">{{ $a->nombre }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <select class="form-control" name="generoID">
                @foreach($generos as $g)
                  <option value="{{ $g->generoID }}">{{ $g->nombre }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <select class="form-control mb-3" name="tipoProductoID">
            @foreach($tipos as $t)
              <option value="{{ $t->tipoProductoID }}">{{ $t->nombre }}</option>
            @endforeach
          </select>

          <button class="btn btn-primary w-100">Save</button>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
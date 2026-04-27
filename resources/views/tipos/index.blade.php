@extends('layouts.app')

@section('title', 'Product Types')

@section('content')

<!-- ================= HEADER + FILTERS ================= -->
<div class="container mt-4 mb-4">

  <form method="GET" action="{{ route('tipos.index') }}">
    <div class="row align-items-center g-2">

      <!-- SEARCH -->
      <div class="col-md-4">
        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               class="form-control"
               placeholder="Search type...">
      </div>

      <!-- ORDER -->
      <div class="col-md-3">
        <select name="orden" class="form-control">
          <option value="">Sort</option>
          <option value="asc" {{ request('orden') == 'asc' ? 'selected' : '' }}>
            A - Z
          </option>
          <option value="desc" {{ request('orden') == 'desc' ? 'selected' : '' }}>
            Z - A
          </option>
        </select>
      </div>

      <!-- BUTTONS (MISMA LÍNEA) -->
      <div class="col-md-5 text-end d-flex justify-content-end gap-2">

        <button type="submit" class="btn btn-primary">
          Filter
        </button>

        <button type="button"
                class="btn btn-primary text-nowrap"
                data-bs-toggle="modal"
                data-bs-target="#createTipoModal">
          Create Type
        </button>

      </div>

    </div>
  </form>

</div>

<!-- ================= CARDS ================= -->
<div class="container">
  <div class="row g-4">

    @forelse($tipos as $tipo)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card text-center p-3 h-100">

          <div class="card-body d-flex flex-column justify-content-between">

            <!-- NAME -->
            <h5 class="card-title">{{ $tipo->nombre }}</h5>
            <p class="text-muted small">{{ $tipo->descripcion }}</p>

            <!-- ACTIONS -->
            <div class="d-flex gap-2 justify-content-center">

              <button class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewTipoModal{{ $tipo->tipoProductoID }}">
                View
              </button>

              <button class="btn btn-outline-secondary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#editTipoModal{{ $tipo->tipoProductoID }}">
                Edit
              </button>

            </div>

          </div>

        </div>

      </div>

      <!-- ================= VIEW MODAL ================= -->
      <div class="modal fade" id="viewTipoModal{{ $tipo->tipoProductoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Type Details</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <p><strong>ID:</strong> {{ $tipo->tipoProductoID }}</p>
              <p><strong>Name:</strong> {{ $tipo->nombre }}</p>
              <p><strong>Description:</strong> {{ $tipo->descripcion }}</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">

              <!-- DELETE -->
              <form action="{{ route('tipos.destroy', $tipo->tipoProductoID) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger"
                        onclick="return confirm('Delete this type?')">
                  Delete
                </button>
              </form>

              <button class="btn btn-primary" data-bs-dismiss="modal">
                Close
              </button>

            </div>

          </div>

        </div>
      </div>

      <!-- ================= EDIT MODAL ================= -->
      <div class="modal fade" id="editTipoModal{{ $tipo->tipoProductoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Edit Type</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

              <form action="{{ route('tipos.update', $tipo->tipoProductoID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text"
                         name="nombre"
                         class="form-control"
                         value="{{ $tipo->nombre }}"
                         required>
                </div>

                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea name="descripcion" class="form-control">{{ $tipo->descripcion }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                  </button>

                  <button class="btn btn-primary">
                    Update
                  </button>
                </div>

              </form>

            </div>

          </div>

        </div>
      </div>

    @empty
      <div class="col-12 text-center">
        <p class="text-muted">No types found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- ================= CREATE MODAL ================= -->
<div class="modal fade" id="createTipoModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create Type</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="{{ route('tipos.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="descripcion" class="form-control"></textarea>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Cancel
            </button>

            <button class="btn btn-primary">
              Save
            </button>
          </div>

        </form>

      </div>

    </div>

  </div>
</div>

@endsection
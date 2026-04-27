@extends('layouts.app')

@section('title', 'Record Labels')

@section('content')

<!-- ================= HEADER + FILTERS ================= -->
<div class="container mt-4 mb-4">

  <form method="GET" action="{{ route('sellos.index') }}">
    <div class="row align-items-center g-2">

      <!-- SEARCH -->
      <div class="col-md-4">
        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               class="form-control"
               placeholder="Search record label...">
      </div>

      <!-- ORDER -->
      <div class="col-md-3">
        <select name="orden" class="form-control">
          <option value="">Sort</option>
          <option value="asc" {{ request('orden') == 'asc' ? 'selected' : '' }}>A - Z</option>
          <option value="desc" {{ request('orden') == 'desc' ? 'selected' : '' }}>Z - A</option>
        </select>
      </div>

      <!-- BUTTONS -->
      <div class="col-md-5 text-end d-flex justify-content-end gap-2">

        <button class="btn btn-primary">
          Filter
        </button>

        <button type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createSelloModal">
          Create Label
        </button>

      </div>

    </div>
  </form>

</div>

<!-- ================= CARDS ================= -->
<div class="container">
  <div class="row g-4">

    @forelse($sellos as $s)

      <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card text-center p-3 h-100">

          <div class="card-body d-flex flex-column justify-content-between">

            <h5 class="card-title">{{ $s->nombre }}</h5>

            <div class="d-flex gap-2 justify-content-center">

              <!-- VIEW -->
              <button class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewSello{{ $s->selloDiscograficoID }}">
                View
              </button>

              <!-- EDIT -->
              <button class="btn btn-outline-secondary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#editSello{{ $s->selloDiscograficoID }}">
                Edit
              </button>

            </div>

          </div>

        </div>

      </div>

      <!-- VIEW MODAL -->
      <div class="modal fade" id="viewSello{{ $s->selloDiscograficoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Label Details</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <p><strong>ID:</strong> {{ $s->selloDiscograficoID }}</p>
              <p><strong>Name:</strong> {{ $s->nombre }}</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">

              <form action="{{ route('sellos.destroy', $s->selloDiscograficoID) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger"
                        onclick="return confirm('Delete this label?')">
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

      <!-- EDIT MODAL -->
      <div class="modal fade" id="editSello{{ $s->selloDiscograficoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Edit Label</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

              <form action="{{ route('sellos.update', $s->selloDiscograficoID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text"
                         name="nombre"
                         class="form-control"
                         value="{{ $s->nombre }}"
                         required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                  </button>

                  <button class="btn btn-warning">
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
        <p class="text-muted">No record labels found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- ================= CREATE MODAL ================= -->
<div class="modal fade" id="createSelloModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create Label</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="{{ route('sellos.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-secondary" data-bs-dismiss="modal">
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
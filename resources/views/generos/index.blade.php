@extends('layouts.app')

@section('title', 'Genres')

@section('content')

<!-- FILTERS -->
<div class="container mt-4 mb-4">

  <form method="GET" action="{{ route('generos.index') }}">
    <div class="row align-items-center g-2">

      <!-- SEARCH -->
      <div class="col-md-4">
        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               class="form-control"
               placeholder="Search genre...">
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
      <div class="col-md-5 text-end">
        <button type="submit" class="btn btn-primary">
          Filter
        </button>

        <button type="button"
                class="btn btn-primary text-nowrap"
                data-bs-toggle="modal"
                data-bs-target="#createGenreModal">
          Create Genre
        </button>

      </div>

    </div>
  </form>

</div>

<!-- CARDS -->
<div class="container">
  <div class="row g-4">

    @forelse($generos as $g)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card text-center p-3 h-100">

          <div class="card-body d-flex flex-column justify-content-between">

            <h5 class="card-title">{{ $g->nombre }}</h5>

        <div class="mt-3 d-flex gap-2 justify-content-center">
              <!-- VIEW -->
              <button type="button"
                      class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewGenreModal{{ $g->generoID }}">
                View
              </button>

              <!-- EDIT -->
              <button type="button"
                      class="btn btn-outline-secondary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#editGenreModal{{ $g->generoID }}">
                Edit
              </button>

            </div>

          </div>

        </div>

      </div>

      <!-- ================= VIEW MODAL ================= -->
      <div class="modal fade" id="viewGenreModal{{ $g->generoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Genre Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <p><strong>ID:</strong> {{ $g->generoID }}</p>
              <p><strong>Name:</strong> {{ $g->nombre }}</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">

              <!-- DELETE -->
              <form action="{{ route('generos.destroy', $g->generoID) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-outline-danger"
                        onclick="return confirm('Are you sure?')">
                  Delete
                </button>
              </form>

              <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                Close
              </button>

            </div>

          </div>

        </div>
      </div>

      <!-- ================= EDIT MODAL ================= -->
      <div class="modal fade" id="editGenreModal{{ $g->generoID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Edit Genre</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

              <form action="{{ route('generos.update', $g->generoID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label class="form-label">Name</label>
                  <input type="text"
                         name="nombre"
                         class="form-control"
                         value="{{ $g->nombre }}"
                         required>
                </div>

                <div class="d-flex justify-content-end gap-2">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                  </button>

                  <button type="submit" class="btn btn-primary">
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
        <p class="text-muted">No genres found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- ================= CREATE MODAL ================= -->
<div class="modal fade" id="createGenreModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create Genre</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="{{ route('generos.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              Cancel
            </button>

            <button type="submit" class="btn btn-primary">
              Save
            </button>
          </div>

        </form>

      </div>

    </div>

  </div>
</div>

@endsection
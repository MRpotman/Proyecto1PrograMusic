@extends('layouts.app')

@section('title', 'Artistas')

@section('content')

<!-- FILTER BAR -->
<div class="container mt-4 mb-4">

  <form method="GET" action="{{ route('artistas.index') }}">
    <div class="row align-items-center g-2">

      <!-- SEARCH -->
      <div class="col-md-3">
        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               class="form-control"
               placeholder="Search artist...">
      </div>

      <!-- ORDER -->
      <div class="col-md-2">
        <select name="orden" class="form-control">
          <option value="">Sort</option>
          <option value="asc" {{ request('orden') == 'asc' ? 'selected' : '' }}>A - Z</option>
          <option value="desc" {{ request('orden') == 'desc' ? 'selected' : '' }}>Z - A</option>
        </select>
      </div>

      <!-- 🎧 SELLO FILTER -->
      <div class="col-md-3">
        <select name="sello" class="form-control">
          <option value="">Record Label</option>
          @foreach(\App\Models\SelloDiscografico::all() as $s)
            <option value="{{ $s->selloDiscograficoID }}"
              {{ request('sello') == $s->selloDiscograficoID ? 'selected' : '' }}>
              {{ $s->nombre }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- BUTTONS -->
      <div class="col-md-4 d-flex gap-2 justify-content-end">

        <button type="submit" class="btn btn-primary">
          Filter
        </button>

        <button type="button"
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#createArtistModal">
          Create Artist
        </button>

      </div>

    </div>
  </form>

</div>

<!-- CARDS -->
<div class="container">
  <div class="row g-4">

    @forelse($artistas as $a)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card text-center p-3 h-100">

          <div class="card-body d-flex flex-column justify-content-between">

            <h5 class="card-title">{{ $a->nombre }}</h5>
            <small class="text-muted">{{ $a->nacionalidad }}</small>
            <small class="text-muted d-block">
            {{ $a->selloDiscografico->nombre ?? 'Sin sello' }}
            </small>

            <div class="mt-3 d-flex gap-2 justify-content-center">

              <!-- VIEW -->
              <button class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewArtistModal{{ $a->artistaID }}">
                View
              </button>

              <!-- EDIT -->
              <button class="btn btn-outline-secondary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#editArtistModal{{ $a->artistaID }}">
                Edit
              </button>

            </div>

          </div>

        </div>

      </div>

      <!-- VIEW MODAL -->
      <div class="modal fade" id="viewArtistModal{{ $a->artistaID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Artist Details</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <p><strong>ID:</strong> {{ $a->artistaID }}</p>
              <p><strong>Name:</strong> {{ $a->nombre }}</p>
              <p><strong>Nationality:</strong> {{ $a->nacionalidad }}</p>
              <p><strong>Label:</strong> {{ $a->selloDiscografico->nombre ?? 'Sin sello' }}</p>
            </div>

            <div class="modal-footer d-flex justify-content-between">

              <form action="{{ route('artistas.destroy', $a->artistaID) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger"
                        onclick="return confirm('Delete this artist?')">
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
      <div class="modal fade" id="editArtistModal{{ $a->artistaID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Edit Artist</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

              <form action="{{ route('artistas.update', $a->artistaID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label>Name</label>
                  <input type="text" name="nombre" class="form-control"
                         value="{{ $a->nombre }}" required>
                </div>

                <div class="mb-3">
                  <label>Nationality</label>
                  <input type="text" name="nacionalidad" class="form-control"
                         value="{{ $a->nacionalidad }}" required>
                </div>

                <div class="mb-3">
                  <label>Record Label</label>
                  <select name="selloDiscograficoID" class="form-control" required>
                    @foreach(\App\Models\SelloDiscografico::all() as $s)
                      <option value="{{ $s->selloDiscograficoID }}"
                        {{ $a->selloDiscograficoID == $s->selloDiscograficoID ? 'selected' : '' }}>
                        {{ $s->nombre }}
                      </option>
                    @endforeach
                  </select>
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
        <p class="text-muted">No artists found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- CREATE MODAL -->
<div class="modal fade" id="createArtistModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create Artist</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="{{ route('artistas.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Nationality</label>
            <input type="text" name="nacionalidad" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Record Label</label>
            <select name="selloDiscograficoID" class="form-control" required>
              @foreach(\App\Models\SelloDiscografico::all() as $s)
                <option value="{{ $s->selloDiscograficoID }}">
                  {{ $s->nombre }}
                </option>
              @endforeach
            </select>
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
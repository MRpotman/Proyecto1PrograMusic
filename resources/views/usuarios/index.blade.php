@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<!-- ERRORS -->
<div class="container mt-3">
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
</div>

<!-- FILTERS -->
<div class="container mt-4 mb-4">

  <form method="GET" action="{{ route('usuarios.index') }}">
    <div class="row align-items-center g-2">

      <!-- SEARCH -->
      <div class="col-md-4">
        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               class="form-control"
               placeholder="Search user...">
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
                class="btn btn-dark"
                data-bs-toggle="modal"
                data-bs-target="#createUserModal">
          + Create User
        </button>

      </div>

    </div>
  </form>

</div>

<!-- CARDS -->
<div class="container">
  <div class="row g-4">

    @forelse($usuarios as $u)
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">

        <div class="card text-center p-3 h-100 shadow-sm">

          <div class="card-body d-flex flex-column justify-content-between">

            <h5 class="card-title">{{ $u->nombre }}</h5>

            <small class="text-muted">{{ $u->email }}</small>

            <small class="text-muted d-block">
              📞 {{ $u->telefono ?? 'No phone' }}
            </small>

            <!-- ROL BADGE -->
            <div class="mt-2">
              <span class="badge {{ $u->rol == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                {{ $u->rol ?? 'user' }}
              </span>
            </div>

            <div class="mt-3 d-flex gap-2 justify-content-center">

              <!-- VIEW -->
              <button class="btn btn-outline-dark btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#viewUserModal{{ $u->usuarioID }}">
                View
              </button>

              <!-- EDIT -->
              <button class="btn btn-outline-secondary btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#editUserModal{{ $u->usuarioID }}">
                Edit
              </button>

            </div>

          </div>

        </div>

      </div>

      <!-- VIEW MODAL -->
      <div class="modal fade" id="viewUserModal{{ $u->usuarioID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">User Details</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
              <p><strong>ID:</strong> {{ $u->usuarioID }}</p>
              <p><strong>Name:</strong> {{ $u->nombre }}</p>
              <p><strong>Email:</strong> {{ $u->email }}</p>
              <p><strong>Phone:</strong> {{ $u->telefono }}</p>
              <p><strong>Address:</strong> {{ $u->direccion }}</p>
              <p><strong>Role:</strong>
                <span class="badge {{ $u->rol == 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                  {{ $u->rol ?? 'user' }}
                </span>
              </p>
            </div>

            <div class="modal-footer d-flex justify-content-between">

              <form action="{{ route('usuarios.destroy', $u->usuarioID) }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="btn btn-outline-danger"
                        onclick="return confirm('Delete this user?')">
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
      <div class="modal fade" id="editUserModal{{ $u->usuarioID }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">

          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title">Edit User</h5>
              <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

              <form action="{{ route('usuarios.update', $u->usuarioID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label>Name</label>
                  <input type="text" name="nombre" class="form-control"
                         value="{{ $u->nombre }}" required>
                </div>

                <div class="mb-3">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control"
                         value="{{ $u->email }}" required>
                </div>

                <div class="mb-3">
                  <label>Phone</label>
                  <input type="text" name="telefono" class="form-control"
                         value="{{ $u->telefono }}">
                </div>

                <div class="mb-3">
                  <label>Address</label>
                  <input type="text" name="direccion" class="form-control"
                         value="{{ $u->direccion }}">
                </div>

                <div class="mb-3">
                  <label>Password <span class="text-muted fw-normal">(optional)</span></label>
                  <input type="password" name="password" class="form-control" minlength="8">
                  <small class="text-muted">Leave empty to keep current password</small>
                </div>

                <!-- ROL -->
                <div class="mb-3">
                  <label>Role</label>
                  <select name="rol" class="form-control">
                    <option value="user"  {{ ($u->rol ?? 'user') == 'user'  ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ ($u->rol ?? 'user') == 'admin' ? 'selected' : '' }}>Admin</option>
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
        <p class="text-muted">No users found</p>
      </div>
    @endforelse

  </div>
</div>

<!-- CREATE MODAL -->
<div class="modal fade" id="createUserModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Create User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="{{ route('usuarios.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="nombre" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>

          <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required minlength="8">
            <small class="text-muted">Minimum 8 characters required</small>
          </div>

          <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="telefono" class="form-control">
          </div>

          <div class="mb-3">
            <label>Address</label>
            <input type="text" name="direccion" class="form-control">
          </div>

          <!-- ROL -->
          <div class="mb-3">
            <label>Role</label>
            <select name="rol" class="form-control">
              <option value="user">User</option>
              <option value="admin">Admin</option>
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
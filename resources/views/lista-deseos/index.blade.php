<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listas de Deseos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Listas de Deseos</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('lista-deseos.create') }}" class="btn btn-primary mb-3">
    Crear Lista
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Fecha Creación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($listas as $lista)
        <tr>
            <td>{{ $lista->listaDeseosID }}</td>
            <td>{{ $lista->usuario->nombre ?? 'Sin usuario' }}</td>
            <td>{{ $lista->fechaCreacion }}</td>
            <td>
                <a href="{{ route('lista-deseos.show', $lista->listaDeseosID) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('lista-deseos.edit', $lista->listaDeseosID) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('lista-deseos.destroy', $lista->listaDeseosID) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
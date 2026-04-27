<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Deseos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Items de Lista de Deseos</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('lista-deseos-items.create') }}" class="btn btn-primary mb-3">Agregar Item</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Lista</th>
            <th>Producto</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->itemListaID }}</td>
            <td>{{ $item->listaDeseos->usuario->nombre ?? 'N/A' }}</td>
            <td>{{ $item->producto->nombre ?? 'N/A' }}</td>
            <td>{{ $item->fechaAgregado }}</td>
            <td>
                <a href="{{ route('lista-deseos-items.show', $item->itemListaID) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('lista-deseos-items.edit', $item->itemListaID) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('lista-deseos-items.destroy', $item->itemListaID) }}" method="POST" style="display:inline;">
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
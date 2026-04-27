<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Items del Carrito</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('carrito-items.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Carrito</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->itemCarritoID }}</td>
            <td>{{ $item->carrito->usuario->nombre ?? 'N/A' }}</td>
            <td>{{ $item->producto->nombre ?? 'N/A' }}</td>
            <td>{{ $item->cantidad }}</td>
            <td>{{ $item->precioUnitario }}</td>
            <td>
                <a href="{{ route('carrito-items.show', $item->itemCarritoID) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('carrito-items.edit', $item->itemCarritoID) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('carrito-items.destroy', $item->itemCarritoID) }}" method="POST" style="display:inline;">
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
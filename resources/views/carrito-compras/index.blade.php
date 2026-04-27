<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Carritos de Compras</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ route('carrito-compras.create') }}" class="btn btn-primary mb-3">
    Crear Carrito
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($carritos as $carrito)
        <tr>
            <td>{{ $carrito->carritoID }}</td>
            <td>{{ $carrito->usuario->nombre ?? 'N/A' }}</td>
            <td>{{ $carrito->total }}</td>
            <td>{{ $carrito->fechaCreacion }}</td>
            <td>
                <a href="{{ route('carrito-compras.show', $carrito->carritoID) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('carrito-compras.edit', $carrito->carritoID) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('carrito-compras.destroy', $carrito->carritoID) }}" method="POST" style="display:inline;">
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
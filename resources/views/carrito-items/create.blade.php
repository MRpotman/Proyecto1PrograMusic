<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar al Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Agregar Producto al Carrito</h2>

<form action="{{ route('carrito-items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Carrito</label>
        <select name="carritoID" class="form-control" required>
            @foreach($carritos as $carrito)
               <option value="{{ $carrito->carritoID }}">Usuario: {{ $carrito->usuario->nombre ?? 'Sin usuario' }} </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Producto</label>
        <select name="productoID" class="form-control" required>
            @foreach($productos as $producto)
                <option value="{{ $producto->productoID }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Cantidad</label>
        <input type="number" name="cantidad" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Precio Unitario</label>
        <input type="number" step="0.01" name="precioUnitario" class="form-control" required>
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

</body>
</html>
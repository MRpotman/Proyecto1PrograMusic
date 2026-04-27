<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Editar Item</h2>

<form action="{{ route('carrito-items.update', $item->itemCarritoID) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Carrito</label>
        <select name="carritoID" class="form-control">
            @foreach($carritos as $carrito)
                <option value="{{ $carrito->carritoID }}"
                    {{ $item->carritoID == $carrito->carritoID ? 'selected' : '' }}>
                    {{ $carrito->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Producto</label>
        <select name="productoID" class="form-control">
            @foreach($productos as $producto)
                <option value="{{ $producto->productoID }}"
                    {{ $item->productoID == $producto->productoID ? 'selected' : '' }}>
                    {{ $producto->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Cantidad</label>
        <input type="number" name="cantidad" value="{{ $item->cantidad }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Precio Unitario</label>
        <input type="number" step="0.01" name="precioUnitario" value="{{ $item->precioUnitario }}" class="form-control">
    </div>

    <button class="btn btn-primary">Actualizar</button>
</form>

</body>
</html>
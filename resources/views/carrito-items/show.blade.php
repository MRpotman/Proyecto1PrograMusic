<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Detalle Item Carrito</h2>

<ul class="list-group">
    <li class="list-group-item"><b>ID:</b> {{ $item->itemCarritoID }}</li>
    <li class="list-group-item"><b>Carrito:</b> {{ $item->carrito->nombre ?? '' }}</li>
    <li class="list-group-item"><b>Producto:</b> {{ $item->producto->nombre ?? '' }}</li>
    <li class="list-group-item"><b>Cantidad:</b> {{ $item->cantidad }}</li>
    <li class="list-group-item"><b>Precio:</b> {{ $item->precioUnitario }}</li>
</ul>

<a href="{{ route('carrito-items.index') }}" class="btn btn-secondary mt-3">Volver</a>

</body>
</html>
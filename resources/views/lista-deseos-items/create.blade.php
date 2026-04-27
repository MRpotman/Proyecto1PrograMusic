<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Agregar a Lista de Deseos</h2>

<form action="{{ route('lista-deseos-items.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Lista de Deseos</label>
        <select name="listaDeseosID" class="form-control" required>
            @foreach($listas as $lista)
                <option value="{{ $lista->listaDeseosID }}">Lista de {{ $lista->usuario->nombre ?? 'N/A' }}</option>
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

    <button class="btn btn-success">Guardar</button>
</form>

</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Crear Carrito de Compras</h2>

<form action="{{ route('carrito-compras.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuarioID" class="form-control" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->usuarioID }}">
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Total</label>
        <input type="number" step="0.01" name="total" class="form-control" value="0">
    </div>

    <button class="btn btn-success">Guardar</button>
</form>

</body>
</html>
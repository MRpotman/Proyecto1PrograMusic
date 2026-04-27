<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Editar Carrito</h2>

<form action="{{ route('carrito-compras.update', $carrito->carritoID) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuarioID" class="form-control">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->usuarioID }}"
                    {{ $carrito->usuarioID == $usuario->usuarioID ? 'selected' : '' }}>
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Total</label>
        <input type="number" step="0.01" name="total" value="{{ $carrito->total }}" class="form-control">
    </div>

    <button class="btn btn-primary">Actualizar</button>
</form>

</body>
</html>
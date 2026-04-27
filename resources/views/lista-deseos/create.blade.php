<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Lista</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Crear Lista de Deseos</h2>

<form method="POST" action="{{ route('lista-deseos.store') }}">
    @csrf

    <div class="mb-3">
        <label>Usuario</label>
        <select name="usuarioID" class="form-control">
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->usuarioID }}">
                    {{ $usuario->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('lista-deseos.index') }}" class="btn btn-secondary">Volver</a>
</form>

</body>
</html>
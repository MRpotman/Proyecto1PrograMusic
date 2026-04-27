<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Editar Item</h2>

<form action="{{ route('lista-deseos-items.update', $item->itemListaID) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Lista de Deseos</label>
        <select name="listaDeseosID" class="form-control">
            @foreach($listas as $lista)
                <option value="{{ $lista->listaDeseosID }}"
                    {{ $item->listaDeseosID == $lista->listaDeseosID ? 'selected' : '' }}>
                    {{ $lista->nombre }}
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

    <button class="btn btn-primary">Actualizar</button>
</form>

</body>
</html>
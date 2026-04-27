<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>

    <!-- Tailwind (simple y rápido) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow text-center">
        <h1 class="text-2xl font-bold mb-6">Sistema</h1>

        <div class="flex flex-col gap-3">
            <a href="{{ route('usuarios.index') }}" 
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Gestión de Usuarios
            </a>
        </div>
    </div>

</body>
</html>
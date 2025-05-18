<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Requerimiento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Nuevo Requerimiento</h1>

        @if (session('success'))
            <div class="bg-green-200 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('requerimientos.store') }}" method="POST" class="grid grid-cols-2 gap-4">
            @csrf

            <input type="text" name="numero_ticket" placeholder="Número de Ticket" class="p-2 border rounded" required>
            <input type="text" name="requerimiento" placeholder="Requerimiento" class="p-2 border rounded">
            <input type="text" name="solicitante" placeholder="Solicitante" class="p-2 border rounded">
            <input type="text" name="negocio" placeholder="Negocio" class="p-2 border rounded">
            <input type="text" name="ambiente" placeholder="Ambiente" class="p-2 border rounded">
            <input type="text" name="capa" placeholder="Capa" class="p-2 border rounded">
            <input type="text" name="servidor" placeholder="Servidor" class="p-2 border rounded">
            <input type="text" name="estado" placeholder="Estado" class="p-2 border rounded">
            <input type="text" name="tipo_solicitud" placeholder="Tipo de Solicitud" class="p-2 border rounded">
            <input type="text" name="tipo_pase" placeholder="Tipo de Pase" class="p-2 border rounded">
            <input type="text" name="ic" placeholder="IC" class="p-2 border rounded">
            <textarea name="observaciones" placeholder="Observaciones" class="p-2 border rounded col-span-2"></textarea>

            <div class="col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Guardar</button>
            </div>
        </form>
    </div>
</body>
</html>


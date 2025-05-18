@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    {{-- Encabezado con hora y turno --}}
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Requerimientos de hoy</h1>

        <div class="text-right text-sm text-gray-700">
            <div id="hora-actual"></div>
            <div>{{ \Carbon\Carbon::now('America/Santiago')->format('Y-m-d') }}</div>
            <div>
                Turno: 
                @php
                    $hora = \Carbon\Carbon::now('America/Santiago')->format('H:i');
                    if ($hora >= '08:00' && $hora <= '11:59') {
                        echo 'mañana';
                    } elseif ($hora >= '12:00' && $hora <= '17:59') {
                        echo 'tarde';
                    } else {
                        echo 'noche';
                    }
                @endphp
            </div>
        </div>
    </div>

    {{-- Tabla --}}
    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="border px-2 py-1"># Ticket</th>
                <th class="border px-2 py-1">Fecha</th>
                <th class="border px-2 py-1">Turno</th>
                <th class="border px-2 py-1">Solicitante</th>
                <th class="border px-2 py-1">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($requerimientos as $req)
                <tr>
                    <td class="border px-2 py-1">{{ $req->numero_ticket }}</td>
                    <td class="border px-2 py-1">{{ $req->fecha_hora }}</td>
                    <td class="border px-2 py-1">{{ $req->turno }}</td>
                    <td class="border px-2 py-1">{{ $req->solicitante }}</td>
                    <td class="border px-2 py-1">{{ $req->estado }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-600">No hay requerimientos ingresados hoy.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Script para mostrar la hora en tiempo real --}}
<script>
    function actualizarHora() {
        const ahora = new Date();
        const hora = ahora.toLocaleTimeString('es-CL');
        document.getElementById('hora-actual').textContent = `Hora: ${hora}`;
    }

    setInterval(actualizarHora, 1000);
    actualizarHora(); // inicial
</script>
@endsection



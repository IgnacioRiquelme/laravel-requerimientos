<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RequerimientoController extends Controller
{
    // Mostrar el formulario de ingreso
    public function create()
    {
        $fechaHora = Carbon::now('America/Santiago');
        
        // Cálculo automático del turno basado en la hora actual
        $hora = $fechaHora->format('H:i');
        if ($hora >= '08:00' && $hora <= '11:59') {
            $turno = 'mañana';
        } elseif ($hora >= '12:00' && $hora <= '17:59') {
            $turno = 'tarde';
        } else {
            $turno = 'noche';
        }

        return view('requerimientos.create', [
            'fechaHora' => $fechaHora->format('Y-m-d H:i:s'),
            'turno' => $turno
        ]);
    }

    // Guardar el requerimiento en la base de datos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_ticket' => 'required|unique:requerimientos,numero_ticket',
            'requerimiento' => 'required|string',
            'solicitante' => 'required|string',
            'negocio' => 'required|string',
            'ambiente' => 'required|string',
            'capa' => 'required|string',
            'servidor' => 'required|string',
            'estado' => 'required|string',
            'tipo_solicitud' => 'required|string',
            'tipo_pase' => 'required|string',
            'ic' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        // Fecha y turno automáticos
        $fechaHora = Carbon::now('America/Santiago');
        $hora = $fechaHora->format('H:i');

        if ($hora >= '08:00' && $hora <= '11:59') {
            $turno = 'mañana';
        } elseif ($hora >= '12:00' && $hora <= '17:59') {
            $turno = 'tarde';
        } else {
            $turno = 'noche';
        }

        DB::table('requerimientos')->insert([
            'fecha_hora' => $fechaHora->format('Y-m-d H:i:s'),
            'turno' => $turno,
            'numero_ticket' => $validated['numero_ticket'],
            'requerimiento' => $validated['requerimiento'],
            'solicitante' => $validated['solicitante'],
            'negocio' => $validated['negocio'],
            'ambiente' => $validated['ambiente'],
            'capa' => $validated['capa'],
            'servidor' => $validated['servidor'],
            'estado' => $validated['estado'],
            'tipo_solicitud' => $validated['tipo_solicitud'],
            'tipo_pase' => $validated['tipo_pase'],
            'ic' => $validated['ic'],
            'observaciones' => $validated['observaciones'],
            'creado_por' => Auth::user()->name, // Aquí se guarda el nombre del usuario logueado
        ]);

        return redirect()->back()->with('success', 'Requerimiento ingresado correctamente.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\User;
use App\Models\Estado;
use App\Models\TipoPago;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CitaController extends Controller
{
// Index - Listar citas
public function index(Request $request)
{
    $busqueda = $request->input('buscar');

    $appointments = \App\Models\Cita::with(['paciente', 'medico', 'estado', 'tipoPago'])
        ->when($busqueda, function ($query, $busqueda) {
            $query->whereHas('paciente', function ($q) use ($busqueda) {
                $q->where('nombre', 'like', "%$busqueda%");
            })->orWhereHas('medico', function ($q) use ($busqueda) {
                $q->where('nombre', 'like', "%$busqueda%");
            });
        })
        ->orderBy('fecha_hora', 'desc')
        ->paginate(5)
        ->withQueryString();

    return Inertia::render('Citas/Index', [
        'appointments' => $appointments,
        'busqueda' => $busqueda,
        'user' => Auth::user(),
    ]);
}


    // Create - Mostrar formulario de creación
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::with('user')->get(); // Carga la relación con usuario
        $estados = Estado::all();
        $tiposPago = TipoPago::all();

        return Inertia::render('Citas/Create', [
            'pacientes' => $pacientes,
            'medicos' => $medicos, // Ahora incluye datos de usuario
            'estados' => $estados,
            'tiposPago' => $tiposPago,
        ]);
    }

    // Store - Guardar nueva cita
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'tipo_pago_id' => 'nullable|exists:tipo_pagos,id',
            'costo' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente!');
    }

    // Show - Mostrar detalles de cita
    public function show(string $id)
    {
        $cita = Cita::with([
            'paciente',
            'medico.user', // ¡Relación anidada crucial!
            'estado',
            'tipoPago'
        ])->findOrFail($id);

        return Inertia::render('Citas/Show', [
            'cita' => $cita,
        ]);
    }

    // Edit - Mostrar formulario de edición
    public function edit(string $id)
    {
        $cita = Cita::findOrFail($id);
        $pacientes = Paciente::all();
        $medicos = Medico::with('user')->get();
        $estados = Estado::all();
        $tiposPago = TipoPago::all();

        return Inertia::render('Citas/Edit', [
            'cita' => $cita,
            'pacientes' => $pacientes,
            'medicos' => $medicos,
            'estados' => $estados,
            'tiposPago' => $tiposPago,
        ]);
    }

    // Update - Actualizar cita existente
    public function update(Request $request, string $id)
    {
        $cita = Cita::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:users,id',
            'fecha_hora' => 'required|date',
            'motivo' => 'required|string|max:255',
            'estado_id' => 'required|exists:estados,id',
            'tipo_pago_id' => 'nullable|exists:tipo_pagos,id',
            'costo' => 'nullable|numeric|min:0',
            'observaciones' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente!');
    }

    // Destroy - Eliminar cita
    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente!');
    }
}

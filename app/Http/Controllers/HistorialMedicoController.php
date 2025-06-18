<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialMedico;
use App\Models\Paciente;
use App\Models\TipoEnfermedad;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HistorialMedicoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $historial = HistorialMedico::with(['paciente', 'tipoEnfermedad'])
            ->when($busqueda, function ($query, $busqueda) {
                $query->whereHas('paciente', function ($q) use ($busqueda) {
                    $q->where('nombre', 'like', "%$busqueda%")
                      ->orWhere('apellidos', 'like', "%$busqueda%");
                })->orWhereHas('tipoEnfermedad', function ($q) use ($busqueda) {
                    $q->where('nombre', 'like', "%$busqueda%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('HistorialMedico/Index', [
            'historial' => $historial,
            'busqueda' => $busqueda,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('HistorialMedico/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'tipo_enfermedad_id' => 'required|exists:tipo_enfermedades,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'fecha' => 'required|date',
        ]);

        HistorialMedico::create([
            'paciente_id' => $request->paciente_id,
            'tipo_enfermedad_id' => $request->tipo_enfermedad_id,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'fecha_diagnostico' => $request->fecha,
            'observaciones' => $request->observaciones,
            'medico_id' => Auth::id(), 
        ]);

        return redirect()->route('historial-medicos.index')->with('success', 'Historial médico creado correctamente.');
    }

    public function edit($id)
    {
        $historial = HistorialMedico::findOrFail($id);

        return Inertia::render('HistorialMedico/Edit', [
            'historial' => $historial
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_enfermedad_id' => 'required|exists:tipo_enfermedades,id',
            'diagnostico' => 'required|string',
            'tratamiento' => 'required|string',
            'fecha_diagnostico' => 'required|date',
        ]);

        $historial = HistorialMedico::findOrFail($id);
        $historial->update([
            'tipo_enfermedad_id' => $request->tipo_enfermedad_id,
            'diagnostico' => $request->diagnostico,
            'tratamiento' => $request->tratamiento,
            'fecha_diagnostico' => $request->fecha_diagnostico,
            'observaciones' => $request->observaciones,
        ]);

        return redirect()->route('historial-medicos.index')->with('success', 'Historial actualizado correctamente.');
    }

    public function destroy($id)
    {
        $historial = HistorialMedico::findOrFail($id);
        $historial->delete();

        return redirect()->route('historial-medicos.index')->with('success', 'Historial eliminado correctamente.');
    }
}

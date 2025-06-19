<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\User;
use App\Models\TipoContrato;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicos = Medico::with(['user', 'tipoContrato'])->paginate(10);

        return Inertia::render('Medicos/Index', [
            'medicos' => $medicos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $doctores = User::where('role', 'Doctor')->get();
    $contratos = TipoContrato::all();
    $usuarioAutenticado = auth()->user(); // ✅

    return Inertia::render('Medicos/Create', [
        'doctores' => $doctores,
        'contratos' => $contratos,
        'user' => $usuarioAutenticado, // ✅ Esto es crucial
    ]);
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'especialidad' => 'required|string|max:255',
            'cedula_profesional' => 'required|string|unique:medicos|max:20',
            'tipo_contrato_id' => 'required|exists:tipo_contratos,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Medico::create($request->all());

        return redirect()->route('medicos.index')->with('success', 'Médico creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $medico = Medico::with(['user', 'tipoContrato', 'citas.paciente'])->findOrFail($id);

        return Inertia::render('Medicos/Show', [
            'medico' => $medico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $medico = Medico::with(['user'])->findOrFail($id); // 🩺 ← ¡esto es lo que faltaba!

    return Inertia::render('Medicos/Edit', [
        'medico' => $medico,
        'doctores' => User::where('role', 'Doctor')->get(),
        'contratos' => TipoContrato::all()
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medico = Medico::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'especialidad' => 'required|string|max:255',
            'cedula_profesional' => 'required|string|unique:medicos,cedula_profesional,' . $medico->id . '|max:20',
            'tipo_contrato_id' => 'required|exists:tipo_contratos,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $medico->update($request->all());

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect()->route('medicos.index')->with('success', 'Médico eliminado exitosamente!');
    }
}

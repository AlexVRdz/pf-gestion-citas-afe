<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $pacientes = Paciente::query()
            ->when($busqueda, function ($query, $busqueda) {
                $query->where('nombre', 'like', "%$busqueda%")
                      ->orWhere('email', 'like', "%$busqueda%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

return Inertia::render('Pacientes/Index', [
            'pacientes' => $pacientes,
            'user' => Auth::user(),
            'busqueda' => $busqueda,
        ]);
    }

    public function create()
    {
        return Inertia::render('Pacientes/Create');
    }

    public function show($id)
{
    $paciente = Paciente::findOrFail($id);

    return Inertia::render('Pacientes/Show', [
        'paciente' => $paciente
    ]);
}



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:M,F',
            'numero_seguro' => 'nullable|string|unique:pacientes,numero_seguro',
        ]);

        Paciente::create($validated);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado correctamente.');
    }

    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);

        return Inertia::render('Pacientes/Edit', [
            'paciente' => $paciente,
        ]);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:M,F',
            'numero_seguro' => 'nullable|string|unique:pacientes,numero_seguro,' . $paciente->id,
        ]);

        $paciente->update($validated);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TipoEnfermedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TipoEnfermedadController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');

        $enfermedades = TipoEnfermedad::query()
            ->when($busqueda, function ($query, $busqueda) {
                $query->where('nombre', 'like', "%$busqueda%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('TipoEnfermedades/Index', [
            'enfermedades' => $enfermedades,
            'busqueda' => $busqueda,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('TipoEnfermedades/Create', [
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'categoria' => 'nullable|string|max:100',
        ]);

        TipoEnfermedad::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
        ]);

        return redirect()->route('tipo-enfermedades.index')->with('success', 'Tipo de enfermedad creado exitosamente.');
    }

    public function edit(string $id)
    {
        $tipoEnfermedad = TipoEnfermedad::findOrFail($id);

        return Inertia::render('TipoEnfermedades/Edit', [
            'tipoEnfermedad' => $tipoEnfermedad,
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'categoria' => 'nullable|string|max:100',
        ]);

        $tipoEnfermedad = TipoEnfermedad::findOrFail($id);

        $tipoEnfermedad->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria' => $request->categoria,
        ]);

        return redirect()->route('tipo-enfermedades.index')->with('success', 'Tipo de enfermedad actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $tipoEnfermedad = TipoEnfermedad::findOrFail($id);
        $tipoEnfermedad->delete();

        return redirect()->route('tipo-enfermedades.index')->with('success', 'Tipo de enfermedad eliminado correctamente.');
    }
}

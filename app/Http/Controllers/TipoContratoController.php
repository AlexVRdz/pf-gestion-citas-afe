<?php

namespace App\Http\Controllers;

use App\Models\TipoContrato;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TipoContratoController extends Controller
{
    public function index(Request $request)
    {
        $busqueda = $request->input('buscar');
        $tiposContrato = TipoContrato::when($busqueda, fn($q) => $q->buscarPorNombre($busqueda))->paginate(10);

        return Inertia::render('TipoContrato/Index', [
            'tiposContrato' => $tiposContrato,
            'busqueda' => $busqueda,
            'user' => Auth::user(),
        ]);
    }

    public function create()
    {
        return Inertia::render('TipoContrato/Create', [
            'user' => Auth::user(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(TipoContrato::crearRules(), TipoContrato::mensajesError());
        TipoContrato::create($validated);

        return redirect()->route('tipo-contratos.index')->with('success', 'Contrato creado exitosamente.');
    }

    public function edit(TipoContrato $tipoContrato)
    {
        return Inertia::render('TipoContrato/Edit', [
            'tipoContrato' => $tipoContrato,
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request, TipoContrato $tipoContrato)
    {
        $validated = $request->validate(TipoContrato::actualizarRules($tipoContrato->id), TipoContrato::mensajesError());
        $tipoContrato->update($validated);

        return redirect()->route('tipo-contratos.index')->with('success', 'Contrato actualizado correctamente.');
    }

    public function destroy(TipoContrato $tipoContrato)
    {
        $tipoContrato->delete();
        return redirect()->route('tipo-contratos.index')->with('success', 'Contrato eliminado correctamente.');
    }

    public function show(TipoContrato $tipoContrato)
    {
        return Inertia::render('TipoContrato/Show', [
            'tipoContrato' => $tipoContrato,
            'user' => Auth::user(),
        ]);
    }
}

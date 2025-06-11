<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        try {
            $estados = Estado::orderBy('nombre')->get();

            return Inertia::render('Estados/Index', [
                'estados' => $estados,
                'users' => $users,
                'user' => Auth::user(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al cargar los estados: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Estados/Create', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            Estado::crearRules(),
            Estado::mensajesError()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            Estado::create($validator->validated());

            return redirect()->route('estados.index')
                ->with('success', 'Estado creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el estado: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $estado = Estado::with('citas')->findOrFail($id);

            return Inertia::render('Estados/Show', [
                'estado' => $estado,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('estados.index')
                ->with('error', 'Estado no encontrado');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $estado = Estado::findOrFail($id);

            return Inertia::render('Estados/Edit', [
                'estado' => $estado,
                'user' => Auth::user(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('estados.index')
                ->with('error', 'Estado no encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            Estado::actualizarRules($id),
            Estado::mensajesError()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $estado = Estado::findOrFail($id);
            $estado->update($validator->validated());

            return redirect()->route('estados.index')
                ->with('success', 'Estado actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el estado: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $estado = Estado::findOrFail($id);

            // Verificar si tiene citas asociadas
            if ($estado->citas()->exists()) {
                return redirect()->back()
                    ->with('error', 'No se puede eliminar: este estado tiene citas asociadas');
            }

            $estado->delete();

            return redirect()->route('estados.index')
                ->with('success', 'Estado eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el estado: ' . $e->getMessage());
        }
    }
}

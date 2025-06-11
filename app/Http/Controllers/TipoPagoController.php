<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TipoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        try {
            $tiposPago = TipoPago::orderBy('nombre')->get();

            return Inertia::render('TipoPagos/Index', [
                'tiposPago' => $tiposPago,
                'users' => $users,
                'user' => Auth::user(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al cargar los tipos de pago: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('TipoPagos/Create', [

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
            TipoPago::crearRules(),
            TipoPago::mensajesError()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            TipoPago::create($validator->validated());

            return redirect()->route('tipo-pagos.index')
                ->with('success', 'Método de pago creado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear el método de pago: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $tipoPago = TipoPago::with('citas')->findOrFail($id);

            return Inertia::render('TipoPagos/Show', [
                'tipoPago' => $tipoPago,

            ]);
        } catch (\Exception $e) {
            return redirect()->route('tipo-pagos.index')
                ->with('error', 'Método de pago no encontrado');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $tipoPago = TipoPago::findOrFail($id);

            return Inertia::render('TipoPagos/Edit', [
                'tipoPago' => $tipoPago,

                'user' => Auth::user(),
            ]);
        } catch (\Exception $e) {
            return redirect()->route('tipo-pagos.index')
                ->with('error', 'Método de pago no encontrado');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make(
            $request->all(),
            TipoPago::actualizarRules($id),
            TipoPago::mensajesError()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $tipoPago = TipoPago::findOrFail($id);
            $tipoPago->update($validator->validated());

            return redirect()->route('tipo-pagos.index')
                ->with('success', 'Método de pago actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar el método de pago: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tipoPago = TipoPago::findOrFail($id);

            // Verificar si tiene citas asociadas
            if ($tipoPago->citas()->exists()) {
                return redirect()->back()
                    ->with('error', 'No se puede eliminar: este método de pago tiene citas asociadas');
            }

            $tipoPago->delete();

            return redirect()->route('tipo-pagos.index')
                ->with('success', 'Método de pago eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el método de pago: ' . $e->getMessage());
        }
    }
}

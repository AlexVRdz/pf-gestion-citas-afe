<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index(Request $request)
{
    $busqueda = $request->input('buscar');

    $appointments = \App\Models\Cita::with(['paciente', 'medico'])
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

return Inertia::render('Pages/Citas/Index', [
        'appointments' => $appointments,
        'busqueda' => $busqueda,
        'user' => Auth::user(),
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

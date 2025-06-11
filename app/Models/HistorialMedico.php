<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'tipo_enfermedad_id',
        'fecha_diagnostico',
        'diagnostico',
        'tratamiento',
        'observaciones'
    ];

    protected $casts = [
        'fecha_diagnostico' => 'date',
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function tipoEnfermedad()
    {
        return $this->belongsTo(TipoEnfermedad::class);
    }
}

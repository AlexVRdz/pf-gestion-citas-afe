<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'especialidad',
        'cedula_profesional',
        'tipo_contrato_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}

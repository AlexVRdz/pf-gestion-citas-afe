<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'telefono',
        'direccion',
        'fecha_nacimiento',
        'genero',
        'numero_seguro'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}

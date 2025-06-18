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

    // Relación con el usuario (doctor)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relación con el tipo de contrato
    public function tipoContrato()
    {
        return $this->belongsTo(TipoContrato::class, 'tipo_contrato_id');
    }

    // Relación con las citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'medico_id');
    }

    // Relación con el historial médico
    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class, 'medico_id');
    }

    // Accesor para obtener el nombre completo del médico
    public function getNombreCompletoAttribute()
    {
        return $this->user ? $this->user->name . ' ' . $this->user->apellidos : '';
    }
}

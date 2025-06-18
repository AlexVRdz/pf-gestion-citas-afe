<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'medico_id',
        'fecha_hora',
        'motivo',
        'estado_id',
        'tipo_pago_id',
        'costo',
        'observaciones'
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
        'costo' => 'decimal:2',
    ];

    public function paciente()
{
    return $this->belongsTo(Paciente::class);
}

public function medico()
{
    return $this->belongsTo(User::class, 'medico_id'); 
}


    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function tipoPago()
    {
        return $this->belongsTo(TipoPago::class);
    }
}

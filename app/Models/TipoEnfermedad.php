<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEnfermedad extends Model
{
    use HasFactory;

    // Esto evita el error con el nombre de la tabla
    protected $table = 'tipo_enfermedades';

    protected $fillable = ['nombre', 'descripcion', 'categoria'];

    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}

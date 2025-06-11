<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEnfermedad extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'categoria'];

    public function historialMedicos()
    {
        return $this->hasMany(HistorialMedico::class);
    }
}

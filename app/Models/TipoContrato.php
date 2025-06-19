<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContrato extends Model
{
    use HasFactory;

    protected $table = 'tipo_contratos';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación con médicos (si aplica)
     */
    public function medicos()
    {
        return $this->hasMany(Medico::class);
    }

    public static function crearRules(): array
    {
        return [
            'nombre' => 'required|string|max:50|unique:tipo_contratos',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public static function actualizarRules($id): array
    {
        return [
            'nombre' => 'required|string|max:50|unique:tipo_contratos,nombre,' . $id,
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    public static function mensajesError(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre no puede exceder los 50 caracteres',
            'nombre.unique' => 'Este nombre ya está registrado',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres',
        ];
    }

    public function scopeBuscarPorNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', '%' . $nombre . '%');
    }

    public function getNombreFormateadoAttribute()
    {
        return ucfirst(strtolower($this->nombre));
    }
}

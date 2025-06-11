<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estados';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación con citas
     */
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    /**
     * Validación para creación
     */
    public static function crearRules(): array
    {
        return [
            'nombre' => 'required|string|max:50|unique:estados',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Validación para actualización
     */
    public static function actualizarRules($id): array
    {
        return [
            'nombre' => 'required|string|max:50|unique:estados,nombre,' . $id,
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Mensajes de error personalizados
     */
    public static function mensajesError(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.max' => 'El nombre no puede exceder los 50 caracteres',
            'nombre.unique' => 'Este nombre ya está registrado',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres',
        ];
    }

    /**
     * Scope para buscar por nombre
     */
    public function scopeBuscarPorNombre($query, $nombre)
    {
        return $query->where('nombre', 'like', '%' . $nombre . '%');
    }

    /**
     * Accessor para formatear el nombre
     */
    public function getNombreFormateadoAttribute()
    {
        return ucfirst(strtolower($this->nombre));
    }
}

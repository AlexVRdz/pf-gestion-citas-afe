<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    public function run()
    {
        $estados = [
            ['nombre' => 'Programada', 'descripcion' => 'Cita programada'],
            ['nombre' => 'En Proceso', 'descripcion' => 'Cita en proceso'],
            ['nombre' => 'Completada', 'descripcion' => 'Cita completada'],
            ['nombre' => 'Cancelada', 'descripcion' => 'Cita cancelada'],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}

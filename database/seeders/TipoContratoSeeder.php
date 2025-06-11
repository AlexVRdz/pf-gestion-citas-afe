<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoContrato;

class TipoContratoSeeder extends Seeder
{
    public function run()
    {
        $tiposContrato = [
            ['nombre' => 'Tiempo Completo', 'descripcion' => 'Contrato de tiempo completo', 'salario' => 50000.00],
            ['nombre' => 'Medio Tiempo', 'descripcion' => 'Contrato de medio tiempo', 'salario' => 25000.00],
            ['nombre' => 'Por Horas', 'descripcion' => 'Contrato por horas', 'salario' => 500.00],
            ['nombre' => 'Consulta Externa', 'descripcion' => 'Médico de consulta externa', 'salario' => 30000.00],
        ];

        foreach ($tiposContrato as $tipoContrato) {
            TipoContrato::create($tipoContrato);
        }
    }
}

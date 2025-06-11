<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoPago;

class TipoPagoSeeder extends Seeder
{
    public function run()
    {
        $tiposPago = [
            ['nombre' => 'Efectivo', 'descripcion' => 'Pago en efectivo'],
            ['nombre' => 'Tarjeta', 'descripcion' => 'Pago con tarjeta'],
            ['nombre' => 'Transferencia', 'descripcion' => 'Transferencia bancaria'],
            ['nombre' => 'Seguro', 'descripcion' => 'Pago por seguro médico'],
        ];

        foreach ($tiposPago as $tipoPago) {
            TipoPago::create($tipoPago);
        }
    }
}

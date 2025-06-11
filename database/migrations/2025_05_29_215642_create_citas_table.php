<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained()->onDelete('cascade');
            $table->foreignId('medico_id')->constrained()->onDelete('cascade');
            $table->datetime('fecha_hora');
            $table->text('motivo');
            $table->foreignId('estado_id')->constrained('estados');
            $table->foreignId('tipo_pago_id')->constrained('tipo_pagos');
            $table->decimal('costo', 8, 2)->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
};

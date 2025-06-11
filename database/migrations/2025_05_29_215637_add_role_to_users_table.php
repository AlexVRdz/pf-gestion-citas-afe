<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['Admin', 'Doctor', 'Secretaria'])->default('Secretaria');
            $table->string('apellidos')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'apellidos', 'direccion', 'telefono']);
        });
    }
};

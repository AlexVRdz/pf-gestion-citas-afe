<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@klinika.com',
            'password' => Hash::make('admin123'),
            'role' => 'Admin',
            'apellidos' => 'Sistema',
            'direccion' => 'Oficina Principal',
            'telefono' => '555-0001',
            'email_verified_at' => now(),
        ]);

        // Doctor
        User::create([
            'name' => 'Dr. Juan',
            'email' => 'doctor@klinika.com',
            'password' => Hash::make('doctor123'),
            'role' => 'Doctor',
            'apellidos' => 'Pérez García',
            'direccion' => 'Consultorio 101',
            'telefono' => '555-0002',
            'email_verified_at' => now(),
        ]);

        // Secretaria
        User::create([
            'name' => 'María',
            'email' => 'secretaria@klinika.com',
            'password' => Hash::make('secretaria123'),
            'role' => 'Secretaria',
            'apellidos' => 'González López',
            'direccion' => 'Recepción Principal',
            'telefono' => '555-0003',
            'email_verified_at' => now(),
        ]);
    }
}

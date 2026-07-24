<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'editor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'moderator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'blocked',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar todos los roles
        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['role' => $role['role']], // Buscar por role
                $role // Crear con estos datos si no existe
            );
        }
    }
}
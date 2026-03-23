<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 🔹 Buat Role
        $adminRole = Role::firstOrCreate(['name' => 'administrator']);
        $instrukturRole = Role::firstOrCreate(['name' => 'instruktur']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Samarinda88')
            ]
        );
        $admin->assignRole($adminRole);

        $instruktur = User::firstOrCreate(
            ['email' => 'instruktur@gmail.com'],
            [
                'name' => 'Instruktur',
                'password' => Hash::make('123456')
            ]
        );
        $instruktur->assignRole($instrukturRole);

        $student = User::firstOrCreate(
            ['email' => 'student@gmail.com'],
            [
                'name' => 'Student',
                'password' => Hash::make('123456')
            ]
        );
        $student->assignRole($studentRole);
    }
}
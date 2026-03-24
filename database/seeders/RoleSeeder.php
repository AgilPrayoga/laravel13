<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'administrator',
            'Manager',
            'Sptd',
            'Spv',
            'Staff',
            'Staff HR',
        ];

        foreach ($permissions as $permission) {
            Role::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}

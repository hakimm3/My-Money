<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'name' => 'user',
                'guard_name' => 'web',
            ],
            [
                'name' => 'super-user',
                'guard_name' => 'web',
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }

        $this->adminPermission();
    }

    private function adminPermission()
    {
        $module = [
            'user',
            'role',
            'permission',
            'pengeluaran',
            'pemasukan'
        ];

        $action = [
            'create',
            'index',
            'update',
            'delete',
        ];

        foreach ($module as $m) {
            foreach ($action as $p) {
              $permission =  Permission::updateOrCreate([
                    'name' => $p . '-' . $m,
                    'guard_name' => 'web',
                ]);

                $role = Role::where('name', 'admin')->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}

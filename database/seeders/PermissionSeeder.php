<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('********** Start inserting permissions');

        foreach (config('permission.permissions_list') as $guard => $permission_list) {
            foreach ($permission_list as $model => $permissions) {
                foreach ($permissions['capabilities'] as $capability) {
                    Permission::firstOrCreate([
                        'name' => $capability . '-' . $model,
                        'guard_name' => $guard
                    ]);
                }
            }
        }

        $this->command->info('********** Permissions were inserted successfully');

        $this->command->info('********** Make super admin role');

        config(['auth.defaults.guard' => 'admin']);
        $role = Role::where('name', 'Super Admin')->first();

        if (!$role) {
            $role = new Role([
                'name' => 'Super Admin',
            ]);

            $role->saveQuietly();
        }

        $this->command->info('********** Super admin role created');

        $role->givePermissionTo(Permission::where('guard_name', 'admin')->get());
    }
}

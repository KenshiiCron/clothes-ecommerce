<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::updateOrCreate(['email'     => 'test@example.com'],[
            'name'      => 'Test Admin',
            'email'     => 'test@example.com',
            'password'  => bcrypt('password'),
        ]);

        $admin->assignRole('Super Admin');

        $this->command->info('Admin Account Has Been Created Successfully');
    }
}

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
        $admin = Admin::updateOrCreate(['email'     => 'admin@app.com'],[
            'name'      => 'Admin',
            'email'     => 'admin@algeorithme.com',
            'password'  => bcrypt('password'),
        ]);

        $admin->assignRole('Super Admin');

        $this->command->info('Admin Account Has Been Created Successfully');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'name'      => 'Site User',
            'email'     => 'user@algeorithme.com',
            'password'  => bcrypt('password'),
        ]);

        $this->command->info('User Account Has Been Created Successfully');
    }
}

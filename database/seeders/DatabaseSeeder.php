<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(WilayaCommuneSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
//        $this->call(OrdersSeeder::class);
//
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
//
//        Admin::create([
//            'name' => 'Test Admin',
//            'email' => 'test@example.com',
//            'password' => bcrypt('password'),
//        ]);
    }
}

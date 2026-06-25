<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Aldan Aldiansyah',
            'phone_number' => '081212341234',
            'role' => 'member',
            'password' => 'aldan1234'
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'zidni',
            'email' => 'zidni@gmail.com',
            'password' => Hash::make('123'),
            'role' => 'admin',
            'status' => 'active',
            'created_at' => now(),
            'phone' => '08123456789',
            'address' => 'Jl. in Aja',
            'city' => 'Bandung',
            'country' => 'Indonesia',
            'postal_code' => '12345',
        ]);
    }
}

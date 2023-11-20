<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Carlos Alberto',
            'last_name' => 'Avalos Soto',
            'gender' => 'M',
            'birth_date' => '2002-09-04',
            'email' => 'carlos.avalos0409@gmail.com',
            'phone_number' => '8713321257',
            'role_id' => 3,
            'password' => Hash::make('admin')
        ]);

        User::create([
            'name' => 'Luis Ángel',
            'last_name' => 'Zapata Zuñiga',
            'gender' => 'M',
            'birth_date' => '2003-08-15',
            'email' => 'luiszapata0815@gmail.com',
            'phone_number' => '8713530073',
            'role_id' => 3,
            'password' => Hash::make('ilovedocker')
        ]);
    }
}

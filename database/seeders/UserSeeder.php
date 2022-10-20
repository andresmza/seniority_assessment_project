<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Andrés',
            'lastname' => 'Ortega',
            'email' => 'andres.mza25@gmail.com',
            'dni' => 34748565,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Admin');
    }
}

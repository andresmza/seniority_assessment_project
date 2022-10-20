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
        //ADMINS
        $user = User::create([
            'name' => 'Andrés',
            'lastname' => 'Ortega',
            'email' => 'andres.mza25@gmail.com',
            'dni' => 34748565,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Admin');
        
        //TEACHERS
        $user = User::create([
            'name' => 'Alberto',
            'lastname' => 'Cortez',
            'email' => 'alberto.cortez@gmail.com',
            'dni' => 15432841,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Teacher');
        
        $user = User::create([
            'name' => 'Mónica',
            'lastname' => 'Guitart',
            'email' => 'monica.guitart@gmail.com',
            'dni' => 15432841,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Teacher');
        
        $user = User::create([
            'name' => 'Adrian',
            'lastname' => 'Barilari',
            'email' => 'adrian.barilari@gmail.com',
            'dni' => 15432841,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Teacher');
        
        //STUDENTS
        $user = User::create([
            'name' => 'Elián Ángel',
            'lastname' => 'Valenzuela',
            'email' => 'elian.420@gmail.com',
            'dni' => 36253492,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Student');

        $user = User::create([
            'name' => 'Gustavo',
            'lastname' => 'Cerati',
            'email' => 'gustavo.cerati@gmail.com',
            'dni' => 13482088,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Student');

        $user = User::create([
            'name' => 'Fito',
            'lastname' => 'Paez',
            'email' => 'fito.paez@gmail.com',
            'dni' => 28621786,
            'password' => bcrypt('12345678'),
            'status' => 1,
        ]);

        $user->assignRole('Student');
    }
}

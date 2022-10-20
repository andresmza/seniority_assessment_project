<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => 'Matemática',
            'description' => 'Ciencia que estudia las propiedades de los números y las relaciones que se establecen entre ellos.',
            'price' => '9.99',
            'duration' => '4',
            'status' => 1,
        ]);

        Subject::create([
            'name' => 'Lengua',
            'description' => 'La lengua es el objeto de estudio de la ciencia lingüística, que es la disciplina encargada de estudiar, analizar y teorizar el conjunto de reglas y principios que interactúan en el funcionamiento de la lengua.',
            'price' => '14.99',
            'duration' => '6',
            'status' => 1,
        ]);

        Subject::create([
            'name' => 'Física',
            'description' => 'La Física es la ciencia que estudia las interacciones fundamentales en la naturaleza, desde lo microscópico a lo macroscópico, las estructuras y cambios que generan.',
            'price' => '19.99',
            'duration' => '6',
            'status' => 1,
        ]);

        Subject::create([
            'name' => 'Química',
            'description' => 'La Química es la ciencia que estudia la materia, la energía y sus cambios. El objeto de estudio de la Química son las sustancias y sus interacciones.',
            'price' => '15.99',
            'duration' => '5',
            'status' => 1,
        ]);
    }
}

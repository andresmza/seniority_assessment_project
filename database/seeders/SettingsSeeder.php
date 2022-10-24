<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'max_courses_per_student' => 5,
            'max_courses_per_teacher_per_week' =>  5,
            'percentage_by_subject' =>  80,
        ]);
    }
}

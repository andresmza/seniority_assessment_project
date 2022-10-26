<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call(set_roles_and_permissions::class);   
        $this->call(UserSeeder::class);   
        $this->call(SubjectSeeder::class);   
        $this->call(SettingsSeeder::class);   


// INSERT INTO courses (teacher_id, subject_id, start_date, end_date) VALUES
// (2, 1, '2022-10-01', '2022-10-10'),
// (2, 1, '2022-10-01', '2022-10-15'),
// (2, 1, '2022-10-15', '2022-10-31'),
// (2, 1, '2022-10-10', '2022-10-20');

// INSERT INTO course_users (course_id, user_id, price) VALUES
// (1,5,10),
// (1,6,15),
// (1,7,20);

    }
}

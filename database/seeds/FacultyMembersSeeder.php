<?php

use Illuminate\Database\Seeder;
use App\FacultyMember;

class FacultyMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacultyMember::create(['name' => 'Ricardo Lopes', 'faculty_category_id' => 1]);
        FacultyMember::create(['name' => 'Jose Juanatey', 'faculty_category_id' => 1]);
        FacultyMember::create(['name' => 'Kausik  Ray', 'faculty_category_id' => 1]);
        FacultyMember::create(['name' => 'Davide Capodanno', 'faculty_category_id' => 1]);
        FacultyMember::create(['name' => 'Pepe Zamorano', 'faculty_category_id' => 1]);

        FacultyMember::create(['name' => 'F Noohi', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Hajar Albinali', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Alawi Alsheikhali', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Wael Almahmeed', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Mohammad Balghith', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Kadhim Sulaiman', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Jassim Alsuwaidi', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Mohammed Alotaibi', 'faculty_category_id' => 2]);
        FacultyMember::create(['name' => 'Hussam Alfaleh', 'faculty_category_id' => 2]);

        FacultyMember::create(['name' => 'Mohammad Aljarallah', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Mustafa Ridha', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Bassam Bulbanat', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Fuad Abdulqader', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Thamer Alessa', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Bader Almahdi', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Wafa Rashed', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Ahmed Abdullah', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Khalid Almarri', 'faculty_category_id' => 3]);
        FacultyMember::create(['name' => 'Mohammed Zubaid', 'faculty_category_id' => 3]);
    }
}

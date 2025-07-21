<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FacultyCategoriesSeeder::class);
        $this->call(FacultyMembersSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(GeneralQuestionsTableSeeder::class);
    }
}

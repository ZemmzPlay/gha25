<?php

use Illuminate\Database\Seeder;
use App\FacultyCategory;

class FacultyCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FacultyCategory::create(['name' => 'International Faculty', 'display_order' => 1]);
        FacultyCategory::create(['name' => 'Regional Faculty', 'display_order' => 2]);
        FacultyCategory::create(['name' => 'Local Faculty', 'display_order' => 3]);
    }
}

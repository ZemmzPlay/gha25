<?php

use Illuminate\Database\Seeder;
use App\GeneralQuestion;

class GeneralQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GeneralQuestion::create(['question' => 'Met the stated objectives']);
        GeneralQuestion::create(['question' => 'Will alter my performance in my practice']);
        GeneralQuestion::create(['question' => 'Will not alter, but showed that I am doing the right thing. ']);
        GeneralQuestion::create(['question' => 'Will be relevant to my practice']);
        GeneralQuestion::create(['question' => 'Made me wish I did not attend it']);
        GeneralQuestion::create(['question' => 'Satisfied my expectations']);
    }
}

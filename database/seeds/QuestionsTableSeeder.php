<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create(['question' => 'Provided objectives and guidelines at the beginning of the presentation so that I knew what I was expected to learn.']);
        Question::create(['question' => 'Presented the content in coherent, understandable fashion.']);
        Question::create(['question' => 'Provided an adequate amount of detail, was neither superficial nor excessively detailed.']);
        Question::create(['question' => 'Demonstrated a thorough knowledge of the subject.']);
        Question::create(['question' => 'Stimulated my interest in the subject.']);
        Question::create(['question' => 'Used well-developed audiovisuals that complemented the presentation.']);
        Question::create(['question' => 'Provided handouts that helped to highlight the important concepts.']);
        Question::create(['question' => 'Presented the content that was appropriate to my level of knowledge.']);
        Question::create(['question' => 'Used an effective presentation style and mannerisms that did not distract my attention.']);
        Question::create(['question' => 'Invited and stimulated audience participation.']);
        Question::create(['question' => ' Used the time allotted efficiently.']);
        Question::create(['question' => 'Language was understandable without communication problems.']);
    }
}

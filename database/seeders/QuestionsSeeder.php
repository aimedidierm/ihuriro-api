<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Question::create([
            'q1' => 'What was the purpose of your visit to the application?',
            'q2' => 'Were you able to complete the purpose your visit?',
            'q3' => 'What other services should the application offer?',
            'q4' => 'How did you first find out about the application?',
            'q5' => 'How likely are you to recommend the application to others?',
            'q6' => 'On a scale of 1 to 10 how satisfied are you with using the application?',
            'q7' => 'Rate your satisfaction with the teams in resolving your issue',
        ]);
    }
}

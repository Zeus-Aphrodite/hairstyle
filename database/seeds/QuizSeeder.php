<?php

use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Quiz::create([
            'name' => 'Hairstyles for personality',
        ]);

        \App\Models\Quiz::create([
            'name' => 'Choose hairstyle you love',
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => 'Your friends would describe you as',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'You Get irritated easily.'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'You are Always willing to help.'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'You avoid philosophical discussions.'
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => 'Do you like meditate',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Not at all.'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Sometimes'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Everyday.'
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => 'For important decisions',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Your head rules your heart.'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Your heart rules your head.'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'You are spontaneus.'
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "You’re more interested in doing things",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'The most logical way.',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'In the grand way of tradition.',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'I always ask.',
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "You’re at a party with people you don’t know",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "You’re mingling and making new friends.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "You’re standing at the edge of the room, wishing you were at home.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "I have no time for parties.",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => 'Pick your favorite decorative pattern',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Skulls and bones",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Nature Landscape",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Cute Animals",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "Your friends would describe you as",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "A very open person.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "A very private person.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Something in the middle.",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "Choose the word that describes you better",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Intelligent.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Smart.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Interesting.",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "Your ideal partner is:",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Smart, Reliable, and logical.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Passionate, sensitive, and romantic.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "I will never find my ideal partner.",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 1,
            'text' => "Your mission in life is:",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Help other people.",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "What mission?",
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => "Something I am still searching.",
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 2,
            'text' => 'What size of hairstyle you do prefer?',
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Short'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Medium'
        ]);
        \App\Models\QuizQuestionOption::create([
            'quiz_question_id' => $q->id,
            'text' => 'Long'
        ]);

        $q = \App\Models\QuizQuestion::create([
            'quiz_id' => 2,
            'text' => 'How old are you?',
        ]);
        $options = [
            '11-14',
            '15-18',
            '19-22',
            '23-25',
            '26-29',
            '30-33',
            '34-37',
            '38-41',
            '42-45',
            '46-48',
            '46-48',
            '49-52',
            'More than 52',
        ];
        foreach ($options as $option) {
            \App\Models\QuizQuestionOption::create([
                'quiz_question_id' => $q->id,
                'text' => $option,
            ]);
        }
    }
}

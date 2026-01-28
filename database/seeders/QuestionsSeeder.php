<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question_text' => 'What is your denomination?',
                'question_type' => 'select',
                'options' => ['Catholic', 'Protestant', 'Orthodox', 'Evangelical', 'Baptist', 'Methodist', 'Lutheran', 'Presbyterian', 'Pentecostal', 'Non-denominational', 'Other'],
                'is_required' => true,
                'display_order' => 1,
            ],
            [
                'question_text' => 'How often do you attend church services?',
                'question_type' => 'select',
                'options' => ['Weekly', 'Multiple times a week', 'A few times a month', 'Monthly', 'Occasionally', 'Rarely'],
                'is_required' => true,
                'display_order' => 2,
            ],
            [
                'question_text' => 'What role does faith play in your daily life?',
                'question_type' => 'select',
                'options' => ['Central to everything I do', 'Very important', 'Moderately important', 'Growing in faith', 'Exploring my faith'],
                'is_required' => true,
                'display_order' => 3,
            ],
            [
                'question_text' => 'What are your views on starting a family?',
                'question_type' => 'select',
                'options' => ['Want children soon', 'Want children someday', 'Open to children', 'Already have children', 'Prefer not to have children', 'Undecided'],
                'is_required' => false,
                'display_order' => 4,
            ],
            [
                'question_text' => 'What are you looking for in a partner?',
                'question_type' => 'textarea',
                'options' => null,
                'is_required' => false,
                'display_order' => 5,
            ],
            [
                'question_text' => 'Describe your ideal first date',
                'question_type' => 'textarea',
                'options' => null,
                'is_required' => false,
                'display_order' => 6,
            ],
            [
                'question_text' => 'What are your hobbies and interests?',
                'question_type' => 'textarea',
                'options' => null,
                'is_required' => false,
                'display_order' => 7,
            ],
            [
                'question_text' => 'What is most important to you in a relationship?',
                'question_type' => 'select',
                'options' => ['Shared faith', 'Communication', 'Trust', 'Family values', 'Emotional connection', 'Respect', 'Friendship'],
                'is_required' => false,
                'display_order' => 8,
            ],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}

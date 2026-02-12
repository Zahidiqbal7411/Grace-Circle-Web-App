<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Question;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = Question::all();
        if ($questions->isEmpty()) {
            $this->command->error('No questions found in database. Please seed questions first.');
            return;
        }

        $genders = ['Male', 'Female'];
        $relationshipStatuses = ['Single', 'Married', 'Divorced', 'Widowed'];
        $lookingFor = ['Friendship', 'Marriage', 'Spirituality', 'Community'];
        $educationLevels = ['High School', 'Bachelor', 'Master', 'PhD'];
        $religions = ['Christian', 'Muslim', 'Hindu', 'Buddhist', 'Atheist', 'Other'];

        for ($i = 1; $i <= 12; $i++) {
            $gender = $genders[array_rand($genders)];
            $name = $gender === 'Male' ? fake()->name('male') : fake()->name('female');
            
            $user = User::create([
                'name' => $name,
                'email' => "testuser{$i}_" . Str::random(4) . "@example.com",
                'password' => Hash::make('password123'),
                'gender' => $gender,
                'age' => rand(18, 65),
                'country' => fake()->country(),
                'city' => fake()->city(),
                'birthday' => Carbon::now()->subYears(rand(18, 65))->subDays(rand(0, 365)),
                'relationship_status' => $relationshipStatuses[array_rand($relationshipStatuses)],
                'looking_for' => $lookingFor[array_rand($lookingFor)],
                'work_as' => fake()->jobTitle(),
                'education' => $educationLevels[array_rand($educationLevels)],
                'languages' => 'English, ' . fake()->languageCode(),
                'interests' => 'Spirituality, Nature, Music',
                'smoking' => rand(0, 1) ? 'Yes' : 'No',
                'eye_color' => 'Brown',
                'religion' => $religions[array_rand($religions)],
                'cast' => 'General',
                'last_seen' => now(),
                'email_status' => '1',
                'email_verified_at' => now(),
                'profile_status' => 1,
            ]);

            // Add Payment
            Payment::create([
                'user_id' => $user->id,
                'valid_till' => now()->addDays(30),
                'stripe_payment_id' => 'ch_' . Str::random(16),
                'stripe_checkout_session_id' => 'cs_' . Str::random(16),
                'amount' => 29.99,
                'currency' => 'USD',
                'status' => 'completed',
                'payment_method' => 'card',
                'notes' => 'Synthetic test data',
            ]);

            // Answer random selection of questions (at least 20)
            $answersCount = rand(20, $questions->count());
            $selectedQuestions = $questions->random($answersCount);

            foreach ($selectedQuestions as $question) {
                // For Yes/No questions or random text
                $answer = rand(0, 1) ? 'Yes' : 'No';
                
                $user->questions()->attach($question->id, [
                    'answer_text' => $answer,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->command->info("Created user: {$user->email}");
        }
    }
}

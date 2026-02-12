<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class UpdateQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear old questions and their answers
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_question_answers')->truncate();
        DB::table('questions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $questions = [
            // Authority over darkness
            ['text' => 'Do you believe in dark forces?', 'category' => 'Authority over darkness'],
            ['text' => 'Do you believe in the devil?', 'category' => 'Authority over darkness'],
            ['text' => 'Do you believe that you can be controlled by evil thoughts?', 'category' => 'Authority over darkness'],
            ['text' => 'Do you believe in temptation?', 'category' => 'Authority over darkness'],
            ['text' => 'Do you know right from wrong?', 'category' => 'Authority over darkness'],
            ['text' => 'Do you have a conscience?', 'category' => 'Authority over darkness'],
            ['text' => 'Are you being truthful and do you know when you are or are things 50-50 for you?', 'category' => 'Authority over darkness'],
            
            // Protection
            ['text' => 'Do you have any regrets defending others?', 'category' => 'Protection'],
            ['text' => 'Would you do it again?', 'category' => 'Protection'],
            ['text' => 'Would you gladly accept any punishment for doing the right thing?', 'category' => 'Protection'],
            ['text' => 'Are you willing to give your life for your principles?', 'category' => 'Protection'],
            
            // Guidance
            ['text' => 'Do you get offended?', 'category' => 'Guidance'],
            ['text' => 'Are you willing to accept you’re wrong?', 'category' => 'Guidance'],
            ['text' => 'Do you think you are always right?', 'category' => 'Guidance'],
            ['text' => 'Can you truthfully say when you are wrong?', 'category' => 'Guidance'],
            ['text' => 'Do you get defensive when you know you’re wrong?', 'category' => 'Guidance'],
            
            // Warfare assistance
            ['text' => 'Do you pick fights with bullies?', 'category' => 'Warfare assistance'],
            ['text' => 'Do you defend your friends against bullies?', 'category' => 'Warfare assistance'],
            ['text' => 'Do you crave beating people up?', 'category' => 'Warfare assistance'],
            ['text' => 'Are you a pushover?', 'category' => 'Warfare assistance'],
            ['text' => 'Do you give people the benefit of the doubt?', 'category' => 'Warfare assistance'],
            
            // Salvation in Christ
            ['text' => 'Do you believe that all your sins were forgiven?', 'category' => 'Salvation in Christ'],
            ['text' => 'Do you believe that you deserve to be forgiven?', 'category' => 'Salvation in Christ'],
            ['text' => 'Do you feel like you were entitled to be forgiven?', 'category' => 'Salvation in Christ'],
            ['text' => 'Do you think you can lose your salvation?', 'category' => 'Salvation in Christ'],
            ['text' => 'Do you know when someone is trying to convince you that you can lose your salvation?', 'category' => 'Salvation in Christ'],
            ['text' => 'Do you believe that that is wrong?', 'category' => 'Salvation in Christ'],
            
            // Pets
            ['text' => 'Are you a dog person?', 'category' => 'Pets'],
            ['text' => 'Are you a cat person?', 'category' => 'Pets'],
            ['text' => 'Are you a horse person?', 'category' => 'Pets'],
            ['text' => 'Do you like birds?', 'category' => 'Pets'],
            ['text' => 'Do you like lizards?', 'category' => 'Pets'],
            ['text' => 'Do you like snakes?', 'category' => 'Pets'],
            ['text' => 'Do you like bugs or scorpions or tarantulas?', 'category' => 'Pets'],
            ['text' => 'Do you love all of God’s creation?', 'category' => 'Pets'],
            
            // Personality
            ['text' => 'Does anything make you freak out?', 'category' => 'Personality'],
            ['text' => 'Are you high strong?', 'category' => 'Personality'],
            ['text' => 'Are you go with the flow?', 'category' => 'Personality'],
            ['text' => 'Do you consider yourself a free thinker or a hippie?', 'category' => 'Personality'],
            
            // Music
            ['text' => 'Do you like music?', 'category' => 'Music'],
            ['text' => 'Do you like country music?', 'category' => 'Music'],
            ['text' => 'Do you like rock music?', 'category' => 'Music'],
            ['text' => 'Do you like soft rock music?', 'category' => 'Music'],
            ['text' => 'Do you like reggae?', 'category' => 'Music'],
            ['text' => 'Do you like classical music?', 'category' => 'Music'],
            ['text' => 'Are you eclectic with your music choices?', 'category' => 'Music'],
            ['text' => 'Do you think that you are creative with music?', 'category' => 'Music'],
            ['text' => 'Do you act upon your creativity via poems, rhymes, sonnets, or songs?', 'category' => 'Music'],
            ['text' => 'Are you confident enough to figure out how to make your creativity come true?', 'category' => 'Music'],
            
            // Activities/Interests
            ['text' => 'Do you like the beach?', 'category' => 'Activities'],
            ['text' => 'Do you like the snow?', 'category' => 'Activities'],
            ['text' => 'Do you like skiing?', 'category' => 'Activities'],
            ['text' => 'Do you like boating?', 'category' => 'Activities'],
            ['text' => 'Do you like sailing?', 'category' => 'Activities'],
            ['text' => 'Do you like paragliding?', 'category' => 'Activities'],
            ['text' => 'Do you like hot air balloon balloons?', 'category' => 'Activities'],
            ['text' => 'Do you like scuba diving?', 'category' => 'Activities'],
            
            // Nature
            ['text' => 'Do you like sunsets?', 'category' => 'Nature'],
            ['text' => 'Do you like sunrises?', 'category' => 'Nature'],
            ['text' => 'Do you like butterflies?', 'category' => 'Nature'],
            ['text' => 'Are your flower person?', 'category' => 'Nature'],
            ['text' => 'Do you like laughter or children laughter?', 'category' => 'Nature'],
            ['text' => 'Do the dogs make you laugh?', 'category' => 'Nature'],
            
            // Animal Intuition
            ['text' => 'Do you believe that cats are spiritual?', 'category' => 'Animal Intuition'],
            ['text' => 'Do you believe that other animals have intuition?', 'category' => 'Animal Intuition'],
            ['text' => 'Do you believe that animals receive messages from God?', 'category' => 'Animal Intuition'],
            
            // Family
            ['text' => 'How many kids do you want?', 'category' => 'Family'],
            ['text' => 'How many grandkids do you want?', 'category' => 'Family'],
            ['text' => 'Do you wanna take large ships with your kids or grandkids?', 'category' => 'Family'],
            ['text' => 'Do you like cruise ships?', 'category' => 'Family'],
            ['text' => 'Do the loud noises or children annoy you?', 'category' => 'Family'],
            ['text' => 'Do you see yourself living on a cruise ship?', 'category' => 'Family'],
            
            // Travel
            ['text' => 'Do you like resorts all inclusive?', 'category' => 'Travel'],
            ['text' => 'Do you like mixed drinks?', 'category' => 'Travel'],
            ['text' => 'Are you a bottled beer person?', 'category' => 'Travel'],
            ['text' => 'Do you know that you could be poisoned on vacation?', 'category' => 'Travel'],
            ['text' => 'Are you naïve with your travel choices?', 'category' => 'Travel'],
            ['text' => 'Do you use technology to travel?', 'category' => 'Travel'],
            ['text' => 'Are you willing to travel last minute?', 'category' => 'Travel'],
            ['text' => 'Are you an ultimate planner a detailed person?', 'category' => 'Travel'],
            ['text' => 'Do you consider yourself Willie Millie?', 'category' => 'Travel'],
            
            // Sentiment & Lifestyle
            ['text' => 'Do you like to collect trinkets?', 'category' => 'Lifestyle'],
            ['text' => 'Do you like to collect meaningful memorabilia?', 'category' => 'Lifestyle'],
            ['text' => 'Are you sentimental?', 'category' => 'Lifestyle'],
            ['text' => 'Do you covet things?', 'category' => 'Lifestyle'],
            ['text' => 'Do you store food?', 'category' => 'Lifestyle'],
            ['text' => 'Are you a hoarder?', 'category' => 'Lifestyle'],
            ['text' => 'Is gold and silver valuable to you?', 'category' => 'Lifestyle'],
            
            // Future
            ['text' => 'How important is your retirement on a scale of one to 10?', 'category' => 'Future'],
            ['text' => 'Do you believe that God has it handled for you?', 'category' => 'Future'],
            ['text' => 'Do you truly believe that God has it handled for you and are you lying? lol', 'category' => 'Future'],
        ];

        foreach ($questions as $index => $q) {
            Question::create([
                'question_text' => $q['text'],
                'category' => $q['category'],
                'question_type' => 'select',
                'options' => ['Yes', 'No'], // Correctly pass an array
                'is_required' => true,
                'display_order' => $index + 1,
                'is_active' => true,
            ]);
        }
    }
}

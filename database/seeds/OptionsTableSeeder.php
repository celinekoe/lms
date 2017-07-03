<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';

        DB::table('options')->insert([
       		'question_id' => '1',
            'option' => 'question1_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'question1_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
        	'question_id' => '1',
            'option' => 'question1_option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'question2_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'question2_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '2',
            'option' => 'question2_option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'question3_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'question3_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '3',
            'option' => 'question3_option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'question1_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'question1_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '4',
            'option' => 'question1_option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'question2_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'question2_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '5',
            'option' => 'question2_option3',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'question3_option1',
            'is_correct' => true,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'question3_option2',
            'is_correct' => false,
            'description' => $description,
        ]);

        DB::table('options')->insert([
            'question_id' => '6',
            'option' => 'question3_option3',
            'is_correct' => false,
            'description' => $description,
        ]);
    }
}

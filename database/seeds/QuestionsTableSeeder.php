<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
       		'quiz_id' => '1',
            'question_no' => '1',
            'question' => 'question1'
        ]);

        DB::table('questions')->insert([
        	'quiz_id' => '1',
            'question_no' => '2',
            'question' => 'question2'
        ]);

        DB::table('questions')->insert([
        	'quiz_id' => '1',
            'question_no' => '3',
            'question' => 'question3'
        ]);

        DB::table('questions')->insert([
            'quiz_id' => '2',
            'question_no' => '1',
            'question' => 'question1'
        ]);

        DB::table('questions')->insert([
            'quiz_id' => '2',
            'question_no' => '2',
            'question' => 'question2'
        ]);

        DB::table('questions')->insert([
            'quiz_id' => '2',
            'question_no' => '3',
            'question' => 'question3'
        ]);
    }
}

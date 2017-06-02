<?php

use Illuminate\Database\Seeder;

class UserQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_questions')->insert([
       		'user_id' => '1',
       		'question_id' => '1',
       		'option_id' => '1'
        ]);

        DB::table('user_questions')->insert([
       		'user_id' => '1',
       		'question_id' => '2',
       		'option_id' => '1'
        ]);

        DB::table('user_questions')->insert([
       		'user_id' => '1',
       		'question_id' => '3',
       		'option_id' => '1'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserQuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_quizzes')->insert([
       		'user_id' => '1',
       		'quiz_id' => '1',
            'attempt_no' => '1',
            'question_no' => '3',
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
        ]);

        DB::table('user_quizzes')->insert([
            'user_id' => '1',
            'quiz_id' => '2',
            'attempt_no' => '1',
            'question_no' => '1',
        ]);
    }
}

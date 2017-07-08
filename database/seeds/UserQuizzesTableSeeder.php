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
        // Test_user1

        DB::table('user_quizzes')->insert([
       		'user_id' => 1,
       		'quiz_id' => 1,
            'attempt_no' => 1,
            'time_limit_remaining' => 0,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        // Test_user2

        DB::table('user_quizzes')->insert([
            'user_id' => 2,
            'quiz_id' => 1,
            'attempt_no' => 1,
            'time_limit_remaining' => 0,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}

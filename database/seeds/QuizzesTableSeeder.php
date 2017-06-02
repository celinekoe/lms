<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizzes')->insert([
       		'subsection_id' => '1',
            'name' => 'quiz1',
            'total_question' => 3,
            'submit_by' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);

        DB::table('quizzes')->insert([
        	'subsection_id' => '1',
            'name' => 'quiz2',
            'total_question' => 3,
            'submit_by' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);

        DB::table('quizzes')->insert([
        	'subsection_id' => '1',
            'name' => 'quiz3',
            'total_question' => 3,
            'submit_by' => Carbon::now()->addDays(30)->format('Y-m-d H:i:s')
        ]);
    }
}

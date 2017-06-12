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
       		'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Quiz1',
            'weight' => 10,
            'total_question' => 3,
            'submit_by_date' => Carbon::now()->addDay()->format('Y-m-d H:i:s')
        ]);

        DB::table('quizzes')->insert([
        	'unit_id' => '1',
            'section_id' => '1',
            'subsection_id' => '1',
            'name' => 'Quiz2',
            'weight' => 10,
            'total_question' => 3,
            'submit_by_date' => Carbon::now()->addDays(2)->format('Y-m-d H:i:s')
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Assignment;
use App\Quiz;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'user_id' => '1',
            'name' => 'event1',
            'full_day' => true,
            'date_start' =>  Carbon::now(),
            'date_end' => Carbon::now(),
        ]);

        $assignment = Assignment::find(1);
        DB::table('events')->insert([
        	'user_id' => '1',
            'assignment_id' => $assignment->id,
            'name' => $assignment->name,
            'full_day' => true,
            'date_start' =>  $assignment->submit_by_date,
            'date_end' => $assignment->submit_by_date,
        ]);

        $quiz = Quiz::find(1);
        DB::table('events')->insert([
            'user_id' => '1',
            'quiz_id' => $quiz->id,
            'name' => $quiz->name,
            'full_day' => true,
            'date_start' =>  $quiz->submit_by_date,
            'date_end' => $quiz->submit_by_date,
        ]);
    }
}

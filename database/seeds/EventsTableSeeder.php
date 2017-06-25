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
        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        DB::table('events')->insert([
            'user_id' => '1',
            'name' => 'Event1',
            'full_day' => true,
            'date_start' =>  Carbon::now(),
            'date_end' => Carbon::now(),
            'description' => $description,
        ]);

        $assignment = Assignment::find(1);
        DB::table('events')->insert([
        	'user_id' => '1',
            'assignment_id' => $assignment->id,
            'name' => $assignment->name,
            'full_day' => true,
            'date_start' =>  $assignment->submit_by_date,
            'date_end' => $assignment->submit_by_date,
            'description' => $description,
        ]);

        $quiz = Quiz::find(1);
        DB::table('events')->insert([
            'user_id' => '1',
            'quiz_id' => $quiz->id,
            'name' => $quiz->name,
            'full_day' => true,
            'date_start' =>  $quiz->submit_by_date,
            'date_end' => $quiz->submit_by_date,
            'description' => $description,
        ]);
    }
}

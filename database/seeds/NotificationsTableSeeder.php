<?php

use Illuminate\Database\Seeder;
use App\Assignment;
use App\Quiz;
use App\Event;
use App\Message;
use Carbon\Carbon;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Test_user1

        $assignment = Assignment::find(1);
        DB::table('notifications')->insert([
        	'user_id' => 1,
            'assignment_id' => $assignment->id,
            'created_at' => Carbon::now(),
        ]);

        $quiz = Quiz::find(1);
        DB::table('notifications')->insert([
            'user_id' => 1,
            'quiz_id' => $quiz->id,
            'created_at' => Carbon::now(),
        ]);

        $event = Event::find(1);
        DB::table('notifications')->insert([
        	'user_id' => 1,
            'event_id' => $event->id,
            'created_at' => Carbon::now(),
        ]);

        // Test_user2

        $assignment = Assignment::find(1);
        DB::table('notifications')->insert([
            'user_id' => 2,
            'assignment_id' => $assignment->id,
            'created_at' => Carbon::now(),
        ]);

        $quiz = Quiz::find(1);
        DB::table('notifications')->insert([
            'user_id' => 2,
            'quiz_id' => $quiz->id,
            'created_at' => Carbon::now(),
        ]);

        $event = Event::find(4);
        DB::table('notifications')->insert([
            'user_id' => 2,
            'event_id' => $event->id,
            'created_at' => Carbon::now(),
        ]);
    }
}

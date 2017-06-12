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
        $assignment = Assignment::find(1);
        DB::table('notifications')->insert([
        	'user_id' => '1',
            'assignment_id' => $assignment->id,
            'read' => false,
            'created_at' => Carbon::now(),
        ]);

        $quiz = Quiz::find(1);
        DB::table('notifications')->insert([
            'user_id' => '1',
            'quiz_id' => $quiz->id,
            'read' => false,
            'created_at' => Carbon::now(),
        ]);

        $event = Event::find(1);
        DB::table('notifications')->insert([
        	'user_id' => '1',
            'event_id' => $event->id,
            'read' => false,
            'created_at' => Carbon::now(),
        ]);

        $message = Message::find(1);
        DB::table('notifications')->insert([
        	'user_id' => '1',
            'message_id' => $message->id,
            'read' => false,
            'created_at' => Carbon::now(),
        ]);
    }
}

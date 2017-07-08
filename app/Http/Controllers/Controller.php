<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Auth;
use App\File;
use App\UserFile;
use App\Assignment;
use App\UserAssignment;
use App\Quiz;
use App\UserQuiz;
use App\UserQuestion;
use App\Thread;
use App\Post;
use App\Event;
use App\Notification;
use App\MessageThread;
use App\Message;
use Carbon\Carbon;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function reset()
    {
    	$user = Auth::user();

    	// reset files and user files

    	UserFile::where('user_id', $user->id)
    		->where('uploaded', true)
    		->delete();

    	File::where('user_id', $user->id)
    		->delete();

            // reset assignment uploaded files

    	$file1 = File::create([
            'user_id' => $user->id,
            'unit_id' => '1',
            'assignment_id' => '1',
            'name' => 'Assignment_file_4',
            'type' => 'document',
            'extension' => '.pdf',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        $user_file1 = UserFile::create([
            'user_id' => $user->id,
            'file_id' => $file1->id,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        $file2 = File::create([
            'user_id' => $user->id,
            'unit_id' => '1',
            'assignment_id' => '2',
            'name' => 'Assignment_file_5',
            'extension' => '.pdf',
            'type' => 'document',
            'url' => 'https://drive.google.com/file/d/0B4OsqsghY0urbVo4b05sc2NIVW8/preview'
        ]);

        $user_file2 = UserFile::create([
            'user_id' => $user->id,
            'file_id' => $file2->id,
            'completed' => false,
            'downloaded' => false,
            'uploaded' => true,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

            // reset other files

        $user_files = UserFile::where('user_id', $user->id)
    		->whereNotIn('file_id', [$user_file1->id, $user_file2->id])
            ->update([
    			'completed' => false,
    			'downloaded' => false,
    			'uploaded' => false,
    		]);

    	// reset user assignments

    	UserAssignment::where('student_id', $user->id)
    		->delete();

    	DB::table('user_assignments')->insert([
        	'student_id' => $user->id,
        	'staff_id' => 3,
        	'assignment_id' => '1',
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'grade_comment' => 'gradecomment1',
            'graded_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => $user->id,
            'staff_id' => 3,
            'assignment_id' => '2',
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);

        DB::table('user_assignments')->insert([
            'student_id' => $user->id,
            'staff_id' => 3,
            'assignment_id' => '3',
            'submitted_at' => null,
            'grade' => null,
            'grade_comment' => null,
            'graded_at' => null,
        ]);

    	// reset user quizzes

        UserQuestion::where('user_id', $user->id)
        	->delete();

    	UserQuiz::where('user_id', $user->id)
    		->delete();

    	$user_quiz = UserQuiz::create([
            'user_id' => $user->id,
       		'quiz_id' => '1',
            'attempt_no' => '1',
            'time_limit_remaining' => 300,
            'submitted_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'grade' => 100,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('user_questions')->insert([
			'user_id' => $user->id,
			'user_quiz_id' => $user_quiz->id,
			'question_id' => '1',
			'option_id' => 1,
        ]);

        DB::table('user_questions')->insert([
			'user_id' => $user->id,
			'user_quiz_id' => $user_quiz->id,
			'question_id' => '2',
			'option_id' => 4,
        ]);

        DB::table('user_questions')->insert([
			'user_id' => $user->id,
			'user_quiz_id' => $user_quiz->id,
			'question_id' => '3',
			'option_id' => 7,
        ]);

    	// reset threads and posts

    	Post::where('user_id', $user->id)
    		->forceDelete();

    	Thread::where('user_id', $user->id)
    		->forceDelete();

    	$thread = Thread::create([
       		'user_id' => $user->id,
       		'forum_id' => '1',
       		'title' => 'Thread1',
            'created_at' => Carbon::now()
        ]);

        $post = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

    	DB::table('posts')->insert([
       		'user_id' => $user->id,
       		'thread_id' => $thread->id,
       		'body' => $post,
        ]);

        DB::table('posts')->insert([
       		'user_id' => $user->id,
       		'thread_id' => $thread->id,
       		'body' => $post,
        ]);

    	// reset notifications and events

    	Notification::where('user_id', $user->id)
    		->forceDelete();

        Event::where('user_id', $user->id)
        	->delete();

        $description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        $event = Event::create([
            'user_id' => $user->id,
            'name' => 'Event1',
            'full_day' => true,
            'date_start' =>  Carbon::now(),
            'date_end' => Carbon::now(),
            'description' => $description,
        ]);

        $assignment = Assignment::find(1);
        DB::table('events')->insert([
        	'user_id' => $user->id,
            'assignment_id' => $assignment->id,
            'name' => $assignment->name,
            'full_day' => true,
            'date_start' =>  $assignment->submit_by_date,
            'date_end' => $assignment->submit_by_date,
            'description' => $description,
        ]);

        $quiz = Quiz::find(1);
        DB::table('events')->insert([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'name' => $quiz->name,
            'full_day' => true,
            'date_start' =>  $quiz->submit_by_date,
            'date_end' => $quiz->submit_by_date,
            'description' => $description,
        ]);

        DB::table('notifications')->insert([
        	'user_id' => $user->id,
            'assignment_id' => $assignment->id,
            'created_at' => Carbon::now(),
        ]);

        DB::table('notifications')->insert([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'created_at' => Carbon::now(),
        ]);

        DB::table('notifications')->insert([
        	'user_id' => $user->id,
            'event_id' => $event->id,
            'created_at' => Carbon::now(),
        ]);

    	// reset messages

    	Message::getQuery()->delete();

    	MessageThread::getQuery()->delete();

    	$message_thread = MessageThread::create([
        	'user_id_1' => '1',
        	'user_id_2' => '2',
            'preview' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

    	$message = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in tortor semper nisi volutpat eleifend. Vivamus auctor ante sit amet mi rutrum, at tristique ipsum molestie. Nam felis tellus, posuere non tincidunt ac, feugiat nec nisi. Sed ullamcorper nec elit at interdum. Maecenas rutrum nisl elementum, lacinia eros lobortis, imperdiet justo. Curabitur pulvinar neque eu sagittis facilisis. Aenean vitae cursus nisi. Donec interdum sem et mauris scelerisque, sed mollis odio rutrum. Cras id sem quis diam convallis fringilla vitae eu sapien.';

        DB::table('messages')->insert([
        	'receiver_id' => '1',
            'sender_id' => '2',
            'message_thread_id' => $message_thread->id,
            'body' => $message,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('messages')->insert([
        	'receiver_id' => '2',
            'sender_id' => '1',
            'message_thread_id' => $message_thread->id,
            'body' => $message,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}

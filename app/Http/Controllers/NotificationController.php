<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Assignment;
use App\Quiz;
use App\Event;
use App\Message;
use App\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Show the notifications page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $notifications = $this->getNotifications($user);

        $data['user'] = $user;
        $data['notifications'] = $notifications;
        
        return view('notifications', ['data' => $data]);
    }

	/**
     * Get notifications.
     *
     * @return App\Notification
     */
    public function getNotifications($user)
    {
        $notifications = Notification::where('user_id', $user->id)->get();
        foreach ($notifications as $notification)
        {
        	if ($notification->assignment_id != null)
        	{
        		$assignment = Assignment::find($notification->assignment_id);
        		$submit_by_date = Carbon::parse($assignment->submit_by_date)->toDateTimeString();
        		$notification->body = $assignment->name . ' is due by ' . $submit_by_date;
        	}
        	else if ($notification->quiz_id != null)
        	{
        		$quiz = Quiz::find($notification->quiz_id);
        		$submit_by_date = Carbon::parse($quiz->submit_by_date)->toDateTimeString();
        		$notification->body = $quiz->name . ' is due by ' . $submit_by_date;
        	}
        	else if ($notification->event_id != null)
        	{
        		$event = Event::find($notification->event_id);
        		$date_start = Carbon::parse($event->date_start)->toDateTimeString();
        		$notification->body = $event->name . ' starts at ' . $date_start;
        	}
        	else if ($notification->message_id != null)
        	{
        		$message = Message::find($notification->message_id);
                $sender = User::find($message->sender_id);
                $created_at_date = Carbon::parse($message->create_at)->toDateTimeString();
        		$notification->body = $sender->name . ' has sent you a message at ' . $created_at_date;
        	}
            $notification->created_at_date = Carbon::parse($notification->created_at)->toDateTimeString();
        }

        return $notifications;
    }    
}

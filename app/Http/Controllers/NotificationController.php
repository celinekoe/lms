<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Assignment;
use App\Quiz;
use App\Event;
use App\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
     * Delete the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function notifications_delete(Request $request)
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)
            ->delete();
    }

    /**
     * Delete the notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification_delete(Request $request)
    {
        $notification = Notification::find($request->notification_id);
        $notification->delete();
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
        		$href = url('unit/'.$assignment->unit_id.'/assignment/'.$notification->assignment_id);
                $submit_by_date = Carbon::parse($assignment->submit_by_date)->toDateTimeString();
        		$notification->body = $assignment->name . ' is due by ' . $submit_by_date;
        	}
        	else if ($notification->quiz_id != null)
        	{
        		$quiz = Quiz::find($notification->quiz_id);
        		$href = url('unit/'.$quiz->unit_id.'/section/'.$quiz->subsection_id.'quiz'.$quiz->id);
                $submit_by_date = Carbon::parse($quiz->submit_by_date)->toDateTimeString();
                $notification->body = $quiz->name . ' is due by ' . $submit_by_date;
                        	}
        	else if ($notification->event_id != null)
        	{
        		$event = Event::find($notification->event_id);
                $href = url('calendar');
        		$date_start = Carbon::parse($event->date_start)->toDateTimeString();
        		$notification->body = $event->name . ' starts at ' . $date_start;
        	}
            $notification->href = $href;
            $notification->created_at_date = Carbon::parse($notification->created_at)->toDateTimeString();
        }

        return $notifications;
    }    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Unit;
use App\Assignment;
use App\Section;
use App\Quiz;
use App\Event;
use App\Notification;
use Calendar;
use Carbon\Carbon;

class CalendarController extends Controller
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
     * Show the calendar page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$user = Auth::user();
    	$calendar = $this->createCalendar($user);

        $data['calendar'] = $calendar;
        
        return view('calendar', ['data' => $data]);
    }

    /**
     * Show the create event page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$event = $this->get_event($request);

        $data['event'] = $event;

        return view('create_event', ['data' => $data]);
    }

    /**
     * Store the created event.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$user = Auth::user();

        if ($request->all_day)
        {
            Event::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'description' => $request->description,
                'all_day' => true,
                'date_start' => $request->date_start,
                'time_start' => null,
                'date_end' => $request->date_end,
                'time_end' => null,
            ]);
        }
        else
        {
            Event::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'description' => $request->description,
                'all_day' => false,
                'date_start' => $request->date_start,
                'time_start' => $request->time_start,
                'date_end' => $request->date_end,
                'time_end' => $request->time_end,
            ]);
        }
    }

    public function edit_event(Request $request)
    {
        $event = $this->get_event($request);
        $event = $this->set_event($event);

        $data['event'] = $event;

        return view('edit_event', ['data' => $data]);
    }

    /**
     * Update the edited event.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_event(Request $request)
    {
        $user = Auth::user();
        $event = $this->get_event($request);

        if ($request->all_day)
        {
            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'all_day' => true,
                'date_start' => $request->date_start,
                'time_start' => null,
                'date_end' => $request->date_end,
                'time_end' => null,
            ]);
        }
        else
        {
            $event->update([
                'name' => $request->name,
                'description' => $request->description,
                'all_day' => false,
                'date_start' => $request->date_start,
                'time_start' => $request->time_start,
                'date_end' => $request->date_end,
                'time_end' => $request->time_end,
            ]);
        }
    }

    public function delete_event(Request $request)
    {
        $user = Auth::user();
        $event = $this->get_event($request);

        $this->delete_event_notifications($user, $event);

        $event->delete();
    }

    private function delete_event_notifications($user, $event)
    {
        $notifications = Notification::where('user_id', $user->id)
            ->where('event_id', $event->id)
            ->delete();
    }

    private function get_event($request)
    {
        $event = Event::find($request->event_id);

        return $event;
    }

    /**
     * Create calendar
     *
     * @return \Illuminate\Http\Response
     */
    private function createCalendar($user)
    {
        $events = Event::where('user_id', $user->id)->get();
    	$calendar_events = [];
    	foreach ($events as $event)
    	{
            if ($event->all_day)
            {
                $calendar_event = Calendar::event(
                    $event->name, 
                    $event->all_day, 
                    $event->date_start, 
                    $event->date_end,
                    $event->id,
                    [
                        'url' => '/calendar/'.$event->id.'/edit',
                    ]
                );
            }
            else
            {

                $date_start = Carbon::parse($event->date_start);
                $time_start = Carbon::parse($event->time_start);
                $date_time_start = Carbon::create($date_start->year, $date_start->month, $date_start->day, $time_start->hour, $time_start->minute, $time_start->second);

                $date_end = Carbon::parse($event->date_end);
                $time_end = Carbon::parse($event->time_end);
                $date_time_end = Carbon::create($date_end->year, $date_end->month, $date_end->day, $time_end->hour, $time_end->minute, $time_end->second);

                $calendar_event = Calendar::event(
                    $event->name, 
                    $event->all_day, 
                    $date_time_start,
                    $date_time_end,
                    $event->id,
                    [
                        'url' => '/calendar/'.$event->id.'/edit',
                    ]
                );
            }
	    	array_push($calendar_events, $calendar_event);
    	}
    	$calendar = Calendar::addEvents($calendar_events, ['color' => '#0275D8', 'textColor' => '#FFFFFF'])
    		->setOptions(['firstDay' => 1]); 
        return $calendar;
    }

    private function set_event($event)
    {
        $formatted_time_start = $this->get_formatted_time_start($event);
        $event = $this->set_formatted_time_start($event, $formatted_time_start);

        $formatted_time_end = $this->get_formatted_time_end($event);
        $event = $this->set_formatted_time_end($event, $formatted_time_end);

        return $event;
    }

    private function get_formatted_time_start($event)
    {
        $formatted_time_start = $this->format_time($event->time_start);

        return $formatted_time_start;
    }

    private function format_time($time)
    {
        $formatted_time = substr($time, 0, -3);

        return $formatted_time;
    }

    private function set_formatted_time_start($event, $formatted_time_start)
    {
        $event->formatted_time_start = $formatted_time_start;

        return $event;
    }

    private function get_formatted_time_end($event)
    {
        $formatted_time_end = $this->format_time($event->time_end);

        return $formatted_time_end;
    }

    private function set_formatted_time_end($event, $formatted_time_end)
    {
        $event->formatted_time_end = $formatted_time_end;

        return $event;
    }
}
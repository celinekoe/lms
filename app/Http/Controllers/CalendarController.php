<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Unit;
use App\Assignment;
use App\Section;
use App\Quiz;
use App\Event;
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
    	$data = null;
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
    	if ($request->full_day == 'on')
    	{
    		$full_day = true;
    	}
    	else
    	{
    		$full_day = false;
    	}
    	$event = Event::create([
    		'user_id' => $user->id,
    		'name' => $request->name,
    		'full_day' => $full_day,
    		'date_start' => $request->date_start,
    		'date_end' => $request->date_end,
    	]);
    	$calendar = $this->createCalendar($user);

    	$data['calendar'] = $calendar;
        
        return view('calendar', ['data' => $data]);
    }

    public function edit_event(Request $request)
    {
        $event = $this->get_event($request);

        $data['event'] = $event;
        
        return view('edit_event', ['data' => $data]);
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
    		$calendar_event = Calendar::event(
	    		$event->name, 
	    		$event->full_day, 
	    		$event->date_start, 
	    		$event->date_end,
	    		$event->id,
	    		[
					'url' => '/calendar/'.$event->id.'/edit',
				]
	    	);
	    	array_push($calendar_events, $calendar_event);
    	}
    	$calendar = Calendar::addEvents($calendar_events, ['color' => '#0275D8', 'textColor' => '#FFFFFF'])
    						->setOptions(['firstDay' => 1]); 
        return $calendar;
    }
}
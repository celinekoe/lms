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
    		if ($event->assignment_id == null && $event->quiz_id == null)
            {
                $url = null;
            }
            else if ($event->assignment_id != null)
    		{
    			$assignment = Assignment::find($event->assignment_id);
    			$unit = Unit::find($assignment->unit_id);
    			$url = url('unit/'.$unit->id.'/assignment/'.$assignment->id);
    		}
    		else if ($event->quiz_id != null)
    		{
    			$quiz = Quiz::find($event->quiz_id);
    			$unit = Unit::find($quiz->unit_id);
    			$section = Section::find($quiz->section_id);
    			$url = url('unit/'.$unit->id.'/section/'.$section->id.'/quiz/'.$quiz->id);
    		}
    		$calendar_event = Calendar::event(
	    		$event->name, 
	    		$event->full_day, 
	    		$event->date_start, 
	    		$event->date_end,
	    		$event->id,
	    		[
					'url' => $url,
				]
	    	);
	    	array_push($calendar_events, $calendar_event);
    	}
    	$calendar = Calendar::addEvents($calendar_events, ['color' => '#0275D8', 'textColor' => '#FFFFFF'])
    						->setOptions(['firstDay' => 1]); 
        return $calendar;
    }
}
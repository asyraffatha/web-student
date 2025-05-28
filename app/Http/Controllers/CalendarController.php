<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar.calendar');
    }

    public function fetchEvents()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function storeEvent(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->save();

        return response()->json($event);
    }
}

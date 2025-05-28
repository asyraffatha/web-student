<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return Event::all();
    }

    public function store(Request $request)
    {
        $event = Event::create($request->all());
        return response()->json($event, 201);
    }

    public function destroy($id)
    {
    $event = Event::findOrFail($id);
    $event->delete();
    return response()->json(null, 204); // Mengembalikan status 204 No Content
    }
}

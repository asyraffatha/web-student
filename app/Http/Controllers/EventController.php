<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
    return Event::where('user_id', Auth::id())->get();
    }
    
    public function store(Request $request)
    {   
    $data = $request->all();
    $data['user_id'] = Auth::id(); // Gunakan Auth::id()
    $event = Event::create($data);
    return response()->json($event, 201);
    }

    public function destroy($id)
    {
    $event = Event::where('id', $id)
                 ->where('user_id', Auth::id())
                 ->firstOrFail();
    $event->delete();
    return response()->json(null, 204);
    }
}

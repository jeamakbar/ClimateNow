<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('creator')->latest()->get();
        $theme = null;
        
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        
        return view('events.index', compact('events', 'theme'));
    }

    public function create()
    {
        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        return view('events.create', compact('theme'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'event_date' => 'required|date',
            'location' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $data['created_by'] = session('user_id');

        Event::create($data);
        return redirect()->route('events.index')->with('success', 'Event created successfully');
    }

    public function show(Event $event)
    {
        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        return view('events.show', compact('event', 'theme'));
    }

    public function join(Event $event)
    {
        EventParticipant::create([
            'event_id' => $event->id,
            'user_id' => session('user_id')
        ]);
        return back()->with('success', 'Successfully joined event');
    }

    public function rate(Request $request, Event $event)
    {
        $request->validate(['rating' => 'required|integer|between:1,5']);

        EventParticipant::where('event_id', $event->id)
            ->where('user_id', session('user_id'))
            ->update(['rating' => $request->rating]);

        return back()->with('success', 'Rating submitted');
    }

    private function checkParticipation($eventId)
    {
        return EventParticipant::where('event_id', $eventId)
                              ->where('user_id', session('user_id'))
                              ->exists();
    }
} 
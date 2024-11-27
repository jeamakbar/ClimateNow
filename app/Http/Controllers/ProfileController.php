<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EventParticipant;
use App\Models\ForumPost;
use App\Models\CarbonCalculation;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(session('user_id'));
        return view('profile.show', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(session('user_id'));

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        if ($request->has('theme')) {
            $user->theme = $request->theme;
            session(['theme' => $request->theme]);
        }

        $user->save();
        return back()->with('success', 'Profile updated successfully');
    }

    public function getStats()
    {
        $userId = session('user_id');
        return [
            'events_joined' => EventParticipant::where('user_id', $userId)->count(),
            'forum_posts' => ForumPost::where('user_id', $userId)->count(),
            'carbon_calculations' => CarbonCalculation::where('user_id', $userId)->count()
        ];
    }
} 
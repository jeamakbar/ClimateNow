<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\EducationalMaterial;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::latest()->get();
        $educationPosts = EducationalMaterial::latest()->get();
        $events = Event::latest()->get();

        return view('admin.dashboard', compact('users', 'educationPosts', 'events'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully');
    }

    public function editEducation($id)
    {
        $post = EducationalMaterial::findOrFail($id);
        return view('admin.education.edit', compact('post'));
    }

    public function updateEducation(Request $request, $id)
    {
        $post = EducationalMaterial::findOrFail($id);
        $post->update($request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'difficulty' => 'required',
            'description' => 'required'
        ]));
        return redirect()->route('admin.dashboard')->with('success', 'Education post updated successfully');
    }

    public function deleteEducation($id)
    {
        $post = EducationalMaterial::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Education post deleted successfully');
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Event deleted successfully');
    }
} 
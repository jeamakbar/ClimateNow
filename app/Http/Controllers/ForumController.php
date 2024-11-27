<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReaction;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use App\Models\User;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = ForumPost::with(['user', 'reactions', 'comments']);
        
        if ($request->category) {
            $query->where('category', $request->category);
        }

        $posts = $query->latest()->get();
        $theme = null;
        
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        
        return view('forum.index', compact('posts', 'theme'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required'
        ]);

        ForumPost::create([
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'user_id' => session('user_id')
        ]);

        return back()->with('success', 'Post created successfully');
    }

    public function react(Request $request, ForumPost $post)
    {
        ForumReaction::updateOrCreate(
            [
                'post_id' => $post->id,
                'user_id' => session('user_id')
            ],
            ['reaction_type' => $request->reaction_type]
        );

        return back();
    }

    public function comment(Request $request, ForumPost $post)
    {
        $request->validate(['content' => 'required']);

        ForumComment::create([
            'post_id' => $post->id,
            'user_id' => session('user_id'),
            'content' => $request->content
        ]);

        return back()->with('success', 'Comment added');
    }

    public function getTrending()
    {
        return ForumPost::withCount('reactions')
                       ->orderBy('reactions_count', 'desc')
                       ->take(5)
                       ->get();
    }

    public function show(ForumPost $post)
    {
        $post->load(['user', 'reactions', 'comments.user']);
        return view('forum.show', compact('post'));
    }

    public function update(Request $request, ForumPost $post)
    {
        if (session('user_id') != $post->user_id && session('role') !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required'
        ]);

        $post->update($validated);
        return redirect()->route('forum.index')->with('success', 'Post updated successfully');
    }

    public function destroy(ForumPost $post)
    {
        if (session('user_id') != $post->user_id && session('role') !== 'admin') {
            abort(403);
        }

        $post->delete();
        return redirect()->route('forum.index')->with('success', 'Post deleted successfully');
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if ($request->is('news/create', 'news/store') && !session('is_admin')) {
                return redirect('/news')->with('error', 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $news = News::with('creator')->latest()->get();
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function store(Request $request)
    {
        if (!session('is_admin')) {
            return back()->with('error', 'Unauthorized');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        $data['created_by'] = session('user_id');

        News::create($data);
        return redirect()->route('news.index')->with('success', 'News created successfully');
    }
} 
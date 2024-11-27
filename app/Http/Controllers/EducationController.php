<?php

namespace App\Http\Controllers;

use App\Models\EducationalMaterial;
use App\Models\User;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index(Request $request)
    {
        $query = EducationalMaterial::query();
        
        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->sort === 'popular') {
            $query->orderBy('views', 'desc');
        } else {
            $query->latest();
        }

        $materials = $query->get();
        $theme = null;
        
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        
        $categories = [
            'terbaru' => 'Terbaru',
            'terpopuler' => 'Terpopuler',
            'pemanasan_global' => 'Pemanasan Global',
            'energi_terbarukan' => 'Energi Terbarukan',
            'konservasi' => 'Konservasi'
        ];

        return view('education.index', compact('materials', 'categories', 'theme'));
    }

    public function create()
    {
        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        return view('education.create', compact('theme'));
    }

    public function store(Request $request)
    {
        if (!session('is_admin')) {
            return back()->with('error', 'Unauthorized');
        }

        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'difficulty' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $data = $request->all();
        $data['image'] = $request->file('image')->store('education', 'public');
        $data['created_by'] = session('user_id');

        EducationalMaterial::create($data);
        return back()->with('success', 'Material added successfully');
    }

    public function show(EducationalMaterial $material)
    {
        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        return view('education.show', compact('material', 'theme'));
    }
} 
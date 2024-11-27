<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\ForumPost;
use App\Models\EducationalMaterial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $breadcrumbs = [];

    public function __construct()
    {
        $this->setBreadcrumb([
            'Home' => '/'
        ]);
    }

    public function index()
    {
        $heroFeatures = [
            [
                'title' => 'Kalkulator Jejak Karbon',
                'description' => 'Hitung dampak aktivitas Anda terhadap lingkungan',
                'link' => '/calculator'
            ],
            [
                'title' => 'Forum Diskusi Climate Change',
                'description' => 'Diskusi dan berbagi tentang perubahan iklim',
                'link' => '/forum'
            ],
            [
                'title' => 'Lokasi Pemantauan Dampak',
                'description' => 'Pantau dampak perubahan iklim di sekitar Anda',
                'link' => '/monitoring'
            ]
        ];

        $latestEvents = Event::latest()->take(3)->get();
        $latestPosts = ForumPost::latest()->take(3)->get();
        $featuredMaterials = EducationalMaterial::where('category', 'terbaru')
                                               ->take(3)
                                               ->get();

        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }

        return view('home.index', compact(
            'heroFeatures',
            'latestEvents',
            'latestPosts',
            'featuredMaterials',
            'theme'
        ));
    }

    public function toggleTheme(Request $request)
    {
        $theme = $request->theme === 'dark' ? 'dark' : 'light';
        
        if (session('user_id')) {
            User::where('id', session('user_id'))
                ->update(['theme' => $theme]);
        }
        
        session(['theme' => $theme]);
        return back();
    }

    public function setBreadcrumb($breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
        view()->share('breadcrumbs', $this->breadcrumbs);
    }
} 
<?php

namespace App\Http\Controllers;

use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function update(Request $request)
    {
        if (!session('is_admin')) {
            return back()->with('error', 'Unauthorized');
        }

        $request->validate([
            'platform' => 'required',
            'url' => 'required|url'
        ]);

        SocialMediaLink::updateOrCreate(
            ['platform' => $request->platform],
            ['url' => $request->url]
        );

        return back()->with('success', 'Social media link updated');
    }

    public function getLinks()
    {
        return SocialMediaLink::all();
    }
} 
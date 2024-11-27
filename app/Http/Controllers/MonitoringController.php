<?php

namespace App\Http\Controllers;

use App\Models\MonitoringLocation;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function index()
    {
        $locations = MonitoringLocation::with('reporter')->latest()->get();
        return view('monitoring.index', compact('locations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'description' => 'required',
            'impact_type' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('monitoring', 'public');
        }
        $data['reported_by'] = session('user_id');

        MonitoringLocation::create($data);
        return back()->with('success', 'Location added successfully');
    }

    public function dashboard()
    {
        $userLocations = MonitoringLocation::where('reported_by', session('user_id'))
                                         ->latest()
                                         ->get();
        return view('monitoring.dashboard', compact('userLocations'));
    }
} 
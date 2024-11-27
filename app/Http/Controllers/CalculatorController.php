<?php

namespace App\Http\Controllers;

use App\Models\CarbonCalculation;
use Illuminate\Http\Request;
use App\Models\User;

class CalculatorController extends Controller
{
    public function index()
    {
        $theme = null;
        if (session('user_id')) {
            $user = User::find(session('user_id'));
            $theme = $user->theme;
        }
        $calculations = CarbonCalculation::where('user_id', session('user_id'))
                                       ->latest()
                                       ->get();
        return view('calculator.index', compact('calculations', 'theme'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'action_type' => 'required',
            'amount' => 'required|numeric|min:0'
        ]);

        $impactValue = $this->calculateImpact(
            $request->action_type,
            $request->amount
        );

        CarbonCalculation::create([
            'user_id' => session('user_id'),
            'action_type' => $request->action_type,
            'amount' => $request->amount,
            'impact_value' => $impactValue
        ]);

        return back()->with('success', 'Calculation saved');
    }

    private function calculateImpact($type, $amount)
    {
        switch ($type) {
            case 'penanaman_pohon':
                return $amount * 21; // 21 kg CO2 per tahun
            case 'pengurangan_plastik':
                return $amount * 1; // 1 kg sampah plastik
            case 'pengurangan_emisi':
                return $amount * 2.3; // 2.3 kg CO2 per liter
            default:
                return 0;
        }
    }

    public function dashboard()
    {
        $totalImpact = CarbonCalculation::where('user_id', session('user_id'))
                                       ->sum('impact_value');
        $calculations = CarbonCalculation::where('user_id', session('user_id'))
                                       ->latest()
                                       ->get();
        return view('calculator.dashboard', compact('totalImpact', 'calculations'));
    }

    public function getStats()
    {
        return [
            'total_impact' => CarbonCalculation::where('user_id', session('user_id'))
                                             ->sum('impact_value'),
            'total_actions' => CarbonCalculation::where('user_id', session('user_id'))
                                              ->count()
        ];
    }
} 
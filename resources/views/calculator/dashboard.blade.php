@extends('layouts.app')

@section('title', 'Carbon Dashboard - ClimateNow')

@section('styles')
<style>
    body {
        background-color: #f0f8f8;
        font-family: 'Lexend';
    }

    .square {
        border-radius: 10px;
        background-color: white;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .title-page {
        margin-top: 80px;
    }

    .dashboard-summary {
        background-color: #78c0bfa4;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
    }

    .impact-value {
        font-size: 1.5em;
        font-weight: bold;
        color: #04738b;
    }

    .calculation-card {
        padding: 15px;
        height: 100%;
    }
</style>
@endsection

@section('content')
<div class="content">
    <h3 class="text-center title-page">Carbon Dashboard</h3>
    
    <div class="container mt-4">
        <div class="dashboard-summary">
            <h3>Total Impact</h3>
            <p class="impact-value">{{ $totalImpact }} kg CO2</p>
        </div>

        <h3 class="mb-4">Calculation History</h3>
        <div class="row g-4">
            @foreach($calculations as $calculation)
                <div class="col-md-4">
                    <div class="square calculation-card">
                        <h5>{{ ucfirst(str_replace('_', ' ', $calculation->action_type)) }}</h5>
                        <p>Amount: {{ $calculation->amount }}</p>
                        <p>Impact: <span class="impact-value">{{ $calculation->impact_value }} kg CO2</span></p>
                        <small class="text-muted">Calculated on: {{ $calculation->created_at->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection 
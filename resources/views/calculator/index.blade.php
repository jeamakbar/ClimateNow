@extends('layouts.app')

@section('title', 'Carbon Calculator - ClimateNow')

@section('styles')
<style>
    /* Common Styles - No Theme Specific */
    .square {
        border-radius: 10px;
        height: 100%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .label-input {
        width: 100%;
        padding: 8px;
        border-radius: 5px;
        margin-top: 5px;
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) {
        background-color: #f0f8f8;
        color: #333;
    }

    body:not(.dark-mode) .square {
        background-color: white;
    }

    body:not(.dark-mode) .label-input {
        background-color: white;
        border: 1px solid #ddd;
        color: #333;
    }

    body:not(.dark-mode) .circle-result {
        background-color: #78c0bfa4;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .square {
        background-color: #2d2d2d;
    }

    body.dark-mode .label-input {
        background-color: #1a1a1a;
        border-color: #404040;
        color: #f5f5f5;
    }

    body.dark-mode .circle-result {
        background-color: #04738b;
        color: #f5f5f5;
    }

    body.dark-mode h3,
    body.dark-mode h6 {
        color: #f5f5f5;
    }

    .button-group {
        margin-top: 20px;
    }

    .inputan {
        margin-top: 10px;
    }

    .btn {
        font-size: 15px;
        background-color: rgb(62, 132, 132);
        color: white;
        border: none;
    }

    .btn-reset {
        background-color: transparent;
        color: rgb(62, 132, 132);
        border: 2px solid rgb(62, 132, 132);
    }

    .circle-result {
        margin-top: 50px;
        background-color: #78c0bfa4;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .title-page {
        margin-top: 80px;
    }

    .container {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')
<div class="content">
    <h3 class="text-center title-page">Carbon Calculator</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 mb-3">
                <div class="square px-3 py-3">
                    <form id="calculatorForm">
                        <div class="inputan">
                            <h6>Action Type</h6>
                            <select class="label-input" id="action_type" required>
                                <option value="">Select Action</option>
                                <option value="tree">Tree Planting (per tree)</option>
                                <option value="plastic">Plastic Reduction (kg)</option>
                                <option value="emission">Emission Reduction (km not driven)</option>
                            </select>
                        </div>

                        <div class="inputan">
                            <h6>Amount</h6>
                            <input type="number" class="label-input" id="amount" min="0" step="0.01" required>
                        </div>

                        <div class="row button-group">
                            <div class="col text-center">
                                <button type="reset" class="btn btn-reset px-4 py-1 rounded-4">RESET</button>
                            </div>
                            <div class="col text-center">
                                <button type="submit" class="btn px-4 py-1 rounded-4">CALCULATE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 mb-3">
                <div id="resultCard" class="square px-3 py-3" style="display: none;">
                    <h6>Carbon Impact Result</h6>
                    <div class="circle-result mx-auto">
                        <h2 id="impactResult">0 kg CO2</h2>
                    </div>
                    <p class="text-center mt-3" id="impactMessage"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(session()->has('user_id'))
            const theme = '{{ $theme }}';
            if (theme) {
                document.body.classList.toggle('dark-mode', theme === 'dark');
            }
        @endif
    });

    function toggleTheme() {
        fetch('{{ route("theme.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                theme: document.body.classList.contains('dark-mode') ? 'light' : 'dark'
            })
        }).then(() => {
            document.body.classList.toggle('dark-mode');
        });
    }

    document.getElementById('calculatorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const actionType = document.getElementById('action_type').value;
        const amount = parseFloat(document.getElementById('amount').value);
        let impact = 0;
        let message = '';

        switch(actionType) {
            case 'tree':
                impact = amount * 22;
                message = `${amount} trees can absorb ${impact}kg of CO2 per year`;
                break;
            case 'plastic':
                impact = amount * 6;
                message = `Reducing ${amount}kg of plastic saves ${impact}kg of CO2`;
                break;
            case 'emission':
                impact = amount * 0.2;
                message = `Not driving ${amount}km saves ${impact}kg of CO2`;
                break;
        }

        document.getElementById('impactResult').textContent = `${impact.toFixed(2)} kg CO2`;
        document.getElementById('impactMessage').textContent = message;
        document.getElementById('resultCard').style.display = 'block';
    });
</script>
@endsection
@endsection 
@extends('layouts.app')

@section('title', 'Profile - ClimateNow')

@section('styles')
<style>
    /* Light Theme Styles */
    body:not(.dark-mode) .profile-container {
        background: white;
        color: #333;
    }

    body:not(.dark-mode) .stats-card {
        background: #f8f9fa;
        color: #333;
    }

    body:not(.dark-mode) .stats-number {
        color: #28a745;
    }

    body:not(.dark-mode) .stats-label {
        color: #666;
    }

    body:not(.dark-mode) .form-label {
        color: #333;
    }

    /* Dark Theme Styles */
    body.dark-mode .profile-container {
        background: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .stats-card {
        background: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .stats-number {
        color: #4cd137;
    }

    body.dark-mode .stats-label {
        color: #aaa;
    }

    body.dark-mode .form-label {
        color: #f5f5f5;
    }

    body.dark-mode .form-control,
    body.dark-mode .form-select {
        background-color: #2d2d2d;
        border-color: #404040;
        color: #f5f5f5;
    }

    /* Common Styles */
    .profile-container {
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 30px;
        margin-bottom: 30px;
    }

    .stats-card {
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .stats-number {
        font-size: 24px;
        font-weight: bold;
    }

    .form-label {
        font-weight: 500;
    }
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('theme').addEventListener('change', function() {
        const isDark = this.value === 'dark';
        document.body.classList.toggle('dark-mode', isDark);
        
        fetch('{{ route("theme.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ theme: this.value })
        });
    });

    // Set initial theme
    document.body.classList.toggle('dark-mode', '{{ $user->theme }}' === 'dark');
</script>
@endsection

@section('content')
<div class="container py-4" style="padding-top: 100px !important;">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-container">
        <h2 class="mb-4">Profile Settings</h2>
        
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $user->events_joined ?? 0 }}</div>
                    <div class="stats-label">Events Joined</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $user->forum_posts ?? 0 }}</div>
                    <div class="stats-label">Forum Posts</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">{{ $user->carbon_calculations ?? 0 }}</div>
                    <div class="stats-label">Carbon Calculations</div>
                </div>
            </div>
        </div>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ $user->name }}" 
                       required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ $user->email }}" 
                       required>
            </div>
            <div class="mb-3">
                <label for="theme" class="form-label">Theme Preference</label>
                <select class="form-select" id="theme" name="theme">
                    <option value="light" {{ $user->theme == 'light' ? 'selected' : '' }}>Light</option>
                    <option value="dark" {{ $user->theme == 'dark' ? 'selected' : '' }}>Dark</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
@endsection 
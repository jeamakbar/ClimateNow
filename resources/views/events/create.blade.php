@extends('layouts.app')

@section('title', 'Create Event - ClimateNow')

@section('styles')
<style>
    /* Light Theme - Colors Only */
    body:not(.dark-mode) .form-container {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode) {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .form-container {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .form-control {
        background-color: #1a1a1a;
        border-color: #404040;
        color: #f5f5f5;
    }

    body.dark-mode .breadcrumb-item a {
        color: #f5f5f5;
    }

    .form-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .btn-submit {
        background-color: #28a745;
        color: white;
        border-radius: 20px;
        padding: 10px 30px;
    }

    .btn-submit:hover {
        background-color: #218838;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">Create Event</li>
        </ol>
    </nav>

    <div class="form-container">
        <h2>Create Event</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Event Name</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="event_date" class="form-label">Event Date</label>
                <input type="date" 
                       class="form-control @error('event_date') is-invalid @enderror" 
                       id="event_date" 
                       name="event_date" 
                       value="{{ old('event_date') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" 
                       class="form-control @error('location') is-invalid @enderror" 
                       id="location" 
                       name="location" 
                       value="{{ old('location') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          name="description" 
                          rows="5" 
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Event Image (Optional)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
            </div>

            <div class="text-end">
                <a href="{{ route('events.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-submit">Create Event</button>
            </div>
        </form>
    </div>
</div>
@endsection 
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
</script>
@endsection
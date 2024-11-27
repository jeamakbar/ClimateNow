@extends('layouts.app')

@section('title', $event->name . ' - ClimateNow')

@section('styles')
<style>
    .event-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .event-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .event-meta {
        color: #666;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .event-content {
        line-height: 1.8;
    }

    .btn-join {
        background-color: #28a745;
        color: white;
        border-radius: 20px;
        padding: 10px 30px;
    }

    .btn-join:hover {
        background-color: #218838;
        color: white;
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) .event-container {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .event-container {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .event-meta {
        color: #aaa;
    }

    body.dark-mode .breadcrumb-item a {
        color: #f5f5f5;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">{{ $event->name }}</li>
        </ol>
    </nav>

    <div class="event-container">
        @if($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" 
                 alt="{{ $event->name }}" 
                 class="event-image">
        @endif

        <h1>{{ $event->name }}</h1>

        <div class="event-meta">
            <span><i class="fas fa-calendar"></i> {{ $event->event_date->format('d M Y, H:i') }}</span>
            <span class="ms-4"><i class="fas fa-map-marker-alt"></i> {{ $event->location }}</span>
        </div>

        <div class="event-content">
            {!! nl2br(e($event->description)) !!}
        </div>

        @if(!$event->participants->contains('user_id', session('user_id')))
            <form action="{{ route('events.join', $event) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" class="btn btn-join">Join Event</button>
            </form>
        @else
            <div class="alert alert-success mt-4">
                You have joined this event.
            </div>
        @endif
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
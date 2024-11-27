@extends('layouts.app')

@section('title', $material->title . ' - ClimateNow')

@section('styles')
<style>
    .material-detail {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 30px;
    }

    .material-detail img {
        border-radius: 10px;
        max-height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .material-meta {
        font-size: 0.9em;
        color: #666;
        margin-top: 10px;
    }

    .material-meta strong {
        color: #333;
    }

    .material-description {
        line-height: 1.6;
        margin-top: 20px;
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) .material-detail {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .material-detail {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .material-meta {
        color: #aaa;
    }

    body.dark-mode .material-meta strong {
        color: #f5f5f5;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="material-detail">
        <h2>{{ $material->title }}</h2>
        <img src="{{ asset('storage/' . $material->image) }}" alt="{{ $material->title }}" class="img-fluid mb-4">
        <div class="material-meta">
            <p><strong>Category:</strong> {{ $material->category }}</p>
            <p><strong>Difficulty:</strong> {{ $material->difficulty }}</p>
            <p><strong>Views:</strong> {{ $material->views }}</p>
        </div>
        <div class="material-description">
            <p>{{ $material->description }}</p>
        </div>
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
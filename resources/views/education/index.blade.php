@extends('layouts.app')

@section('title', 'Educational Materials - ClimateNow')

@section('styles')
<style>
    body {
        background-color: rgb(242, 252, 255);
        font-family: 'Lexend';
        margin-top: 20px;
    }

    ul.filters {
        display: block;
        width: 100%;
        margin: 0;
        padding: 30px 0;
    }

    ul.filters > li {
        list-style: none;
        display: inline-block;
    }

    ul.filters > li > a {
        display: block;
        color: #434e5e;
        text-decoration: none;
        padding: 5px 20px;
    }

    ul.filters > li > a:hover {
        background-color: #e6e9ed;
    }

    ul.filters > li.active > a {
        color: #fff;
        background-color: #609695;
    }

    .material-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        border: 0;
    }

    .material-card:hover {
        transform: scale(1.01);
    }

    .search-bar {
        margin-top: 80px;
    }

    .btn {
        background-color: rgb(62, 132, 132);
        border: 0;
        color: white;
        font-weight: 600;
        font-family: 'Lexend';
    }

    .btn:hover {
        background-color: #04738b;
    }

    .material-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .difficulty-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.8em;
        color: white;
    }

    .difficulty-beginner { background-color: #609695; }
    .difficulty-intermediate { background-color: #ffc107; }
    .difficulty-advanced { background-color: #dc3545; }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) {
        background-color: rgb(242, 252, 255);
    }

    body:not(.dark-mode) .material-card {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .material-card {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .text-muted {
        color: #aaa !important;
    }

    body.dark-mode .filters a {
        color: #f5f5f5;
    }

    body.dark-mode .form-control {
        background-color: #1a1a1a;
        border-color: #404040;
        color: #f5f5f5;
    }
</style>
@endsection

@section('content')
<div class="content">
    <!-- Search bar -->
    <div class="row justify-content-center me-3 ms-3">
        <form class="d-flex justify-content-center search-bar">
            <input class="form-control me-2" type="search" placeholder="Search Materials" aria-label="Search">
            <button class="btn" type="button">Search</button>
        </form>
    </div>

    <!-- Filter categories -->
    <ul class="filters text-center">
        <li class="{{ !request('category') ? 'active' : '' }}">
            <a href="{{ route('education.index') }}">All Materials</a>
        </li>
        @foreach($categories as $key => $name)
            <li class="{{ request('category') == $key ? 'active' : '' }}">
                <a href="?category={{ $key }}">{{ $name }}</a>
            </li>
        @endforeach
    </ul>

    <div class="container">
        <div class="row g-4">
            @foreach($materials as $material)
                <div class="col-md-4">
                    <div class="material-card position-relative">
                        <img src="{{ asset('storage/' . $material->image) }}" 
                             alt="{{ $material->title }}" 
                             class="material-image">
                        
                        <span class="difficulty-badge difficulty-{{ strtolower($material->difficulty) }}">
                            {{ $material->difficulty }}
                        </span>

                        <div class="card-body p-3">
                            <h5 class="card-title">{{ $material->title }}</h5>
                            <p class="card-text-desc">{{ Str::limit($material->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted">
                                    <i class="fas fa-eye"></i> {{ $material->views }} views
                                </span>
                                <a href="{{ route('education.show', $material) }}" class="btn btn-sm">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
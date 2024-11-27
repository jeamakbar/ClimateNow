@extends('layouts.app')

@section('title', 'Events - ClimateNow')

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

    .event-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        border: 0;
    }

    .event-card:hover {
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
        color: white;
    }

    .plus-sign {
        position: fixed;
        bottom: 50px;
        right: 75px;
        width: 50px;
        height: 50px;
        background-color: #609695;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20%;
        cursor: pointer;
    }

    .vertical-line,
    .horizontal-line {
        width: 50%;
        height: 4px;
        background-color: white;
        position: absolute;
    }

    .vertical-line {
        transform: rotate(90deg);
    }

    @media only screen and (max-width: 767px) {
        .plus-sign {
            bottom: 30px;
            right: 30px;
            width: 40px;
            height: 40px;
        }
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) {
        background-color: rgb(242, 252, 255);
    }

    body:not(.dark-mode) .event-card {
        background-color: white;
        color: #333;
    }

    body:not(.dark-mode) .filters a {
        color: #434e5e;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .event-card {
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
            <input class="form-control me-2" type="search" placeholder="Search Events" aria-label="Search">
            <button class="btn" type="button">Search</button>
        </form>
    </div>

    <!-- Filter categories -->
    <ul class="filters text-center">
        <li class="active"><a href="#!">All Events</a></li>
        <li><a href="#!">Upcoming</a></li>
        <li><a href="#!">Past Events</a></li>
        <li><a href="#!">Featured</a></li>
    </ul>

    <div class="container">
        <div class="row g-4">
            @foreach($events as $event)
                <div class="col-md-4">
                    <div class="event-card p-3">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" 
                                 class="card-img-top rounded mb-3" 
                                 alt="{{ $event->name }}"
                                 style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x200?text=No+Image" 
                                 class="card-img-top rounded mb-3" 
                                 alt="Default Event Image">
                        @endif

                        <div class="card-body p-0">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text text-muted mb-2">
                                <i class="fas fa-calendar me-2"></i>{{ $event->event_date->format('d M Y, H:i') }}
                            </p>
                            <p class="card-text text-muted mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>{{ $event->location }}
                            </p>
                            <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="text-muted">
                                    <i class="fas fa-users me-1"></i>
                                    {{ $event->participants->count() }} Joined
                                </span>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-sm">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="plus-sign" onclick="window.location.href='{{ route('events.create') }}'">
        <div class="vertical-line"></div>
        <div class="horizontal-line"></div>
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
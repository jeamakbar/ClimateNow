@extends('layouts.app')

@section('title', 'ClimateNow - Home')

@section('styles')
<style>
    .c-item {
        height: 500px;
    }

    .c-img {
        height: 100%;
        object-fit: cover;
        filter: brightness(0.5);
    }

    .c-title {
        font-size: 40px;
        font-weight: 500;
    }

    .c-isi {
        font-size: 25px;
    }

    .carousel-caption {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        align-items: center;
        justify-content: center;
    }

    .carousel-caption .text-center {
        max-width: 80%;
        margin: auto;
    }

    .btn-slider {
        background-color: white;
        border: 0;
        color: black;
        font-weight: 600;
        font-family: 'Lexend';
        padding: 8px 25px;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-slider:hover {
        background-color: black;
        color: white;
    }

    .card {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        border: 0;
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.01);
    }

    @media only screen and (max-width: 450px) {
        .c-item {
            height: 550px;
        }

        .c-title {
            font-size: 25px;
        }

        .c-isi {
            font-size: 15px;
        }
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) {
        background-color: rgb(242, 252, 255);
    }

    body:not(.dark-mode) .card {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .card {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .text-muted {
        color: #aaa !important;
    }

    body.dark-mode h3,
    body.dark-mode h5 {
        color: #f5f5f5;
    }

    body.dark-mode .btn-slider {
        background-color: #f5f5f5;
        color: #1a1a1a;
    }

    body.dark-mode .btn-slider:hover {
        background-color: #2d2d2d;
        color: #f5f5f5;
        border: 1px solid #f5f5f5;
    }
</style>
@endsection

@section('content')
<!-- Carousel Slider -->
<div id="hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#hero-carousel" data-bs-slide-to="2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active c-item" data-bs-interval="4000">
            <img src="{{ asset('images/calculator-banner.jpg') }}" class="d-block w-100 c-img" alt="Calculator">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <p class="c-title mt-5">Kalkulator Karbon</p>
                    <p class="c-isi">Hitung dampak aktivitas Anda terhadap lingkungan</p>
                    <a href="{{ route('calculator.index') }}">
                        <button class="btn-slider">Coba</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="carousel-item c-item" data-bs-interval="4000">
            <img src="{{ asset('images/forum-banner.jpg') }}" class="d-block w-100 c-img" alt="Forum">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <p class="c-title mt-5">Forum Diskusi</p>
                    <p class="c-isi">Berbagi informasi dan pengalaman tentang perubahan iklim</p>
                    <a href="{{ route('forum.index') }}">
                        <button class="btn-slider">Kunjungi</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="carousel-item c-item" data-bs-interval="4000">
            <img src="{{ asset('images/events-banner.jpg') }}" class="d-block w-100 c-img" alt="Events">
            <div class="carousel-caption d-flex align-items-center justify-content-center">
                <div class="text-center">
                    <p class="c-title mt-5">Event Lingkungan</p>
                    <p class="c-isi">Ikuti kegiatan untuk mendukung kelestarian lingkungan</p>
                    <a href="{{ route('events.index') }}">
                        <button class="btn-slider">Lihat Event</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#hero-carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#hero-carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Card Sections -->
<div class="container mx-auto">
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-3 mx-auto">
        <!-- Latest Events -->
        <div class="col mx-auto">
            <h3 class="text-center">EVENT TERBARU</h3>
            <div class="container">
                @foreach($latestEvents as $event)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/' . $event->image) }}" 
                                     class="img-fluid rounded-start img-custom-height-home" 
                                     alt="Event Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $event->name }}</h5>
                                    <p class="card-text-desc-home">{{ Str::limit($event->description, 100) }}</p>
                                    <p class="card-text-date"><small class="text-muted">{{ $event->event_date->format('d M Y') }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Latest Forum Posts -->
        <div class="col mx-auto">
            <h3 class="text-center">DISKUSI TERBARU</h3>
            <div class="container">
                @foreach($latestPosts as $post)
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text-desc">{{ Str::limit($post->content, 100) }}</p>
                                    <p class="card-text-date">
                                        <small class="text-muted">By {{ $post->user->name }} - {{ $post->created_at->format('d M Y') }}</small>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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

    function toggleTheme() {
        fetch('/theme/toggle', {
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
</script>
@endsection 
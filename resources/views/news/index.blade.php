@extends('layouts.app')

@section('title', 'News - ClimateNow')

@section('styles')
<style>
    .news-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 20px;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .news-content {
        padding: 20px;
    }

    .news-meta {
        font-size: 0.9em;
        color: #666;
    }

    .btn-create-news {
        background-color: #28a745;
        color: white;
        border-radius: 20px;
        padding: 10px 20px;
        margin-bottom: 20px;
    }

    .btn-create-news:hover {
        background-color: #218838;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Latest News</h2>
        @if(session('is_admin'))
            <a href="{{ route('news.create') }}" class="btn btn-create-news">
                <i class="fas fa-plus"></i> Create News
            </a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @foreach($news as $item)
            <div class="col-md-4">
                <div class="news-card">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" 
                             alt="{{ $item->title }}" 
                             class="news-image">
                    @else
                        <img src="https://via.placeholder.com/400x200?text=No+Image" 
                             alt="No Image" 
                             class="news-image">
                    @endif
                    <div class="news-content">
                        <h5>{{ $item->title }}</h5>
                        <p>{{ Str::limit($item->content, 100) }}</p>
                        <div class="news-meta">
                            <span><i class="fas fa-user"></i> {{ $item->creator->name }}</span>
                            <span class="ms-3"><i class="fas fa-calendar"></i> {{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <a href="{{ route('news.show', $item) }}" class="btn btn-primary mt-3">
                            Read More
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 
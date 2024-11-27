@extends('layouts.app')

@section('title', $news->title . ' - ClimateNow')

@section('styles')
<style>
    .news-container {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .news-image {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .news-meta {
        color: #666;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .news-content {
        line-height: 1.8;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active">{{ $news->title }}</li>
        </ol>
    </nav>

    <div class="news-container">
        @if($news->image)
            <img src="{{ asset('storage/' . $news->image) }}" 
                 alt="{{ $news->title }}" 
                 class="news-image">
        @endif

        <h1>{{ $news->title }}</h1>

        <div class="news-meta">
            <span><i class="fas fa-user"></i> {{ $news->creator->name }}</span>
            <span class="ms-4"><i class="fas fa-calendar"></i> {{ $news->created_at->format('d M Y, H:i') }}</span>
        </div>

        <div class="news-content">
            {!! nl2br(e($news->content)) !!}
        </div>
    </div>
</div>
@endsection 
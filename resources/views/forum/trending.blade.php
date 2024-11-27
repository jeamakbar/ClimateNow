@extends('layouts.app')

@section('title', 'Trending Forum Posts - ClimateNow')

@section('styles')
<style>
    .trending-post-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 20px;
        padding: 20px;
    }

    .trending-post-card:hover {
        transform: translateY(-5px);
    }

    .post-meta {
        font-size: 0.9em;
        color: #666;
    }
</style>
@endsection

@section('content')
<div class="container py-4">
    <h2>Trending Forum Posts</h2>

    <div class="row">
        @foreach($trendingPosts as $post)
            <div class="col-md-6">
                <div class="trending-post-card">
                    <h5>{{ $post->title }}</h5>
                    <p>{{ Str::limit($post->content, 100) }}</p>
                    <div class="post-meta">
                        <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                        <span class="ms-3"><i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span><i class="fas fa-thumbs-up"></i> {{ $post->reactions->count() }}</span>
                        <a href="{{ route('forum.show', $post) }}" class="btn btn-outline-primary btn-sm">View Comments</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection 
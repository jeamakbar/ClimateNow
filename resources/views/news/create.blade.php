@extends('layouts.app')

@section('title', 'Create News - ClimateNow')

@section('styles')
<style>
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
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
            <li class="breadcrumb-item active">Create News</li>
        </ol>
    </nav>

    <div class="form-container">
        <h2>Create News</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       required>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" 
                          name="content" 
                          rows="10" 
                          required>{{ old('content') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (Optional)</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*">
            </div>

            <div class="text-end">
                <a href="{{ route('news.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-submit">Create News</button>
            </div>
        </form>
    </div>
</div>
@endsection 
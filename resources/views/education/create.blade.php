@extends('layouts.app')

@section('title', 'Add Educational Material - ClimateNow')

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

    /* Light Theme - Colors Only */
    body:not(.dark-mode) .form-container {
        background-color: white;
        color: #333;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .form-container {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .form-control,
    body.dark-mode .form-select {
        background-color: #1a1a1a;
        border-color: #404040;
        color: #f5f5f5;
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
            <li class="breadcrumb-item"><a href="{{ route('education.index') }}">Education</a></li>
            <li class="breadcrumb-item active">Add Material</li>
        </ol>
    </nav>

    <div class="form-container">
        <h2>Add Educational Material</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('education.store') }}" method="POST" enctype="multipart/form-data">
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
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" 
                        id="category" 
                        name="category" 
                        required>
                    <option value="">Select Category</option>
                    <option value="pemanasan_global">Pemanasan Global</option>
                    <option value="energi_terbarukan">Energi Terbarukan</option>
                    <option value="konservasi">Konservasi</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="difficulty" class="form-label">Difficulty Level</label>
                <select class="form-select @error('difficulty') is-invalid @enderror" 
                        id="difficulty" 
                        name="difficulty" 
                        required>
                    <option value="">Select Difficulty</option>
                    <option value="beginner">Beginner</option>
                    <option value="intermediate">Intermediate</option>
                    <option value="advanced">Advanced</option>
                </select>
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
                <label for="image" class="form-label">Cover Image</label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/*" 
                       required>
            </div>

            <div class="text-end">
                <a href="{{ route('education.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-submit">Add Material</button>
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
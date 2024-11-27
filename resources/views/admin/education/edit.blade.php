@extends('layouts.app')

@section('title', 'Edit Education Post - ClimateNow')

@section('styles')
<style>
    .edit-container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
    }

    .edit-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .form-control {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        margin-bottom: 15px;
    }

    .btn-admin {
        background-color: #609695;
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
@endsection

@section('content')
<div class="edit-container">
    <div class="edit-card">
        <h3>Edit Education Post</h3>
        <form action="{{ route('admin.education.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
            </div>
            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control" rows="6" required>{{ $post->content }}</textarea>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn-admin">Update Post</button>
            </div>
        </form>
    </div>
</div>
@endsection 
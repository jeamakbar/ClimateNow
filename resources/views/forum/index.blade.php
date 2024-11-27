@extends('layouts.app')

@section('title', 'Forum - ClimateNow')

@section('styles')
<style>
    /* Common Styles - No Theme Specific */
    .forum-post-card {
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin: 15px 0;
        cursor: pointer;
        transition: transform 0.3s ease;
        position: relative;
    }

    .forum-post-card h5 {
        font-size: 20px;
        margin-bottom: 15px;
    }

    .forum-post-card p {
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 20px;
    }

    .post-meta {
        font-size: 14px;
    }

    .modal-content {
        border-radius: 10px;
        padding: 20px;
    }

    .modal-body input,
    .modal-body textarea,
    .modal-body select {
        padding: 12px;
        margin-bottom: 15px;
        border-radius: 5px;
        font-size: 16px;
    }

    .plus-sign {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    /* Light Theme - Colors Only */
    body:not(.dark-mode) {
        background-color: rgb(242, 252, 255);
    }

    body:not(.dark-mode) .forum-post-card {
        background-color: #fff;
        color: #333;
    }

    body:not(.dark-mode) .post-meta {
        color: #666;
    }

    body:not(.dark-mode) .modal-content {
        background-color: #fff;
        color: #333;
    }

    body:not(.dark-mode) .modal-body input,
    body:not(.dark-mode) .modal-body textarea,
    body:not(.dark-mode) .modal-body select {
        background-color: #fff;
        color: #333;
        border: 1px solid #ccc;
    }

    body:not(.dark-mode) .plus-sign {
        background-color: #04738b;
    }

    /* Dark Theme - Colors Only */
    body.dark-mode {
        background-color: #1a1a1a;
        color: #f5f5f5;
    }

    body.dark-mode .forum-post-card {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .post-meta {
        color: #aaa;
    }

    body.dark-mode .modal-content {
        background-color: #2d2d2d;
        color: #f5f5f5;
    }

    body.dark-mode .modal-body input,
    body.dark-mode .modal-body textarea,
    body.dark-mode .modal-body select {
        background-color: #1a1a1a;
        border-color: #404040;
        color: #f5f5f5;
    }

    body.dark-mode .plus-sign {
        background-color: #04738b;
    }

    /* Add these new styles */
    body.dark-mode .text-dark,
    body.dark-mode a.text-dark,
    body.dark-mode h5,
    body.dark-mode h6,
    body.dark-mode .modal-title {
        color: #f5f5f5 !important;
    }

    body.dark-mode .btn-close {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Rest of your existing styles */
    .search-bar {
        margin-top: 80px;
        margin-bottom: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-edit {
        color: #04738b;
        background: none;
        border: none;
        padding: 0 5px;
    }

    .btn-delete {
        color: #dc3545;
        background: none;
        border: none;
        padding: 0 5px;
    }

    .post-actions {
        display: flex;
        gap: 10px;
    }

    .forum-post-card .post-actions {
        position: absolute;
        right: 25px;
        top: 25px;
        z-index: 2;
    }

    .flex-grow-1 {
        flex-grow: 1;
    }
</style>
@endsection

@section('content')
<div class="content" style="padding-top: 20px;">
    <div class="row justify-content-center me-3 ms-3">
        <form class="d-flex justify-content-center search-bar">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn" type="button">Search</button>
        </form>
    </div>

    <div class="container">
        @foreach($posts as $post)
            <div class="forum-post-card">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('forum.show', $post) }}" class="text-decoration-none text-dark flex-grow-1">
                        <h5>{{ $post->title }}</h5>
                    </a>
                    @if(session()->has('user_id') && (session('user_id') == $post->user_id || session('role') === 'admin'))
                        <div class="post-actions">
                            <button class="btn btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editPostModal{{ $post->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('forum.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                <a href="{{ route('forum.show', $post) }}" class="text-decoration-none text-dark">
                    <p>{{ Str::limit($post->content, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="post-meta">
                            <span><i class="fas fa-user"></i> {{ $post->user->name }}</span>
                            <span class="ms-3"><i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}</span>
                        </div>
                        <span><i class="fas fa-thumbs-up"></i> {{ $post->reactions->count() }}</span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    @if(session()->has('user_id'))
        <div class="plus-sign" data-bs-toggle="modal" data-bs-target="#createPostModal">
            <div class="vertical-line"></div>
            <div class="horizontal-line"></div>
        </div>
    @else
        <div class="text-center mt-4">
            <p>Please <a href="{{ route('login') }}">login</a> to create a post</p>
        </div>
    @endif

    @if(session()->has('user_id'))
        <div class="modal fade" id="createPostModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('forum.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <h6>Post Title</h6>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <h6>Post Content</h6>
                                <textarea class="form-control" name="content" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <h6>Category</h6>
                                <select class="form-control" name="category" required>
                                    <option value="energi terbarukan">Energi Terbarukan</option>
                                    <option value="transportasi ramah lingkungan">Transportasi Ramah Lingkungan</option>
                                    <option value="daur ulang">Daur Ulang & Pengelolaan Sampah</option>
                                    <option value="konservasi">Konservasi Lingkungan</option>
                                    <option value="gaya hidup hijau">Gaya Hidup Hijau</option>
                                    <option value="umum">Umum</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @foreach($posts as $post)
        <!-- Edit Modal -->
        <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('forum.update', $post) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <h6>Post Title</h6>
                                <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                            </div>
                            <div class="mb-3">
                                <h6>Post Content</h6>
                                <textarea class="form-control" name="content" rows="3" required>{{ $post->content }}</textarea>
                            </div>
                            <div class="mb-3">
                                <h6>Category</h6>
                                <select class="form-control" name="category" required>
                                    <option value="energi terbarukan" {{ $post->category === 'energi terbarukan' ? 'selected' : '' }}>Energi Terbarukan</option>
                                    <option value="transportasi ramah lingkungan" {{ $post->category === 'transportasi ramah lingkungan' ? 'selected' : '' }}>Transportasi Ramah Lingkungan</option>
                                    <option value="daur ulang" {{ $post->category === 'daur ulang' ? 'selected' : '' }}>Daur Ulang & Pengelolaan Sampah</option>
                                    <option value="konservasi" {{ $post->category === 'konservasi' ? 'selected' : '' }}>Konservasi Lingkungan</option>
                                    <option value="gaya hidup hijau" {{ $post->category === 'gaya hidup hijau' ? 'selected' : '' }}>Gaya Hidup Hijau</option>
                                    <option value="umum" {{ $post->category === 'umum' ? 'selected' : '' }}>Umum</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
        fetch('{{ route("theme.toggle") }}', {
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
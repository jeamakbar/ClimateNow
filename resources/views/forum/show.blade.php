@extends('layouts.app')

@section('title', $post->title . ' - ClimateNow')

@section('styles')
<style>
    body {
        background-color: rgb(242, 252, 255);
        font-family: 'Lexend';
    }

    .container-forum {
        align-items: center;
        max-width: 90%;
        margin: 20px auto;
    }

    .breadcrumb-container {
        background-color: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-top: 80px;
    }

    .forum-post {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin: 10px 0;
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .post-author {
        display: flex;
        align-items: center;
    }

    .post-author img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .post-date {
        color: #000000;
    }

    .post-content {
        margin-bottom: 15px;
    }

    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .span-square-kategori {
        margin-top: 0px;
    }

    .square-kategori {
        width: 10px;
        height: 10px;
        display: inline-block;
    }

    .text-kategori {
        font-size: 15px;
        margin: 0;
    }

    .post-views {
        color: #78c0bf;
    }

    .post-replies {
        border-top: 1px solid #ccc;
        margin-top: 15px;
        padding-top: 15px;
    }

    .reply {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #ccc;
    }

    .reply:last-child {
        border-bottom: none;
    }

    .add-comment {
        display: flex;
        align-items: center;
        margin-top: 20px;
    }

    .add-comment input[type="text"] {
        flex: 1;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        margin-right: 10px;
        font-size: 16px;
    }

    .btn {
        background-color: rgb(62, 132, 132);
        border: 0;
        color: white;
        font-weight: 600;
        font-family: 'Lexend';
        font-size: 16px;
        padding: 10px 20px;
    }

    .btn:hover {
        background-color: #04738b;
        color: white;
    }

    .review-actions {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 10px;
    }

    .review-actions .fa {
        cursor: pointer;
        color: #6c757d;
        transition: color 0.3s;
    }

    .review-actions .fa:hover {
        color: #007bff;
    }

    @media only screen and (max-width: 767px) {
        .btn {
            font-size: 12px;
            padding: 12px 10px;
        }
        
        .post-date {
            font-size: smaller;
        }
    }

    .comment-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        margin: 10px 0;
    }

    .comment-form textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        margin-bottom: 10px;
        font-size: 16px;
        font-family: 'Lexend';
    }

    .comment-form h4 {
        margin-bottom: 15px;
        color: #333;
    }
</style>
@endsection

@section('content')
<div class="content">
    <div class="breadcrumb-container me-3 ms-3">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Home</a> <span>></span>
            <a href="{{ route('forum.index') }}">Forum</a> <span>></span>
            <span>{{ $post->title }}</span>
        </div>
    </div>

    <div class="container-forum">
        <div class="forum-post">
            <div class="post-header">
                <div class="post-author">
                    <img src="https://i.pinimg.com/originals/f1/0f/f7/f10ff70a7155e5ab666bcdd1b45b726d.jpg" alt="Photo Profile">
                    

                    <span>{{ $post->user->name }}</span>
                </div>
                <span class="post-date">{{ $post->created_at->format('d F Y') }}</span>
            </div>
            
            <div class="post-content">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->content }}</p>
            </div>
            
            <div class="post-footer">
                <span class="d-flex align-items-center span-square-kategori">
                    <span class="square-kategori bg-success me-2"></span>
                    <h6 class="text-success text-kategori">{{ $post->category }}</h6>
                </span>
                <span class="post-views">{{ $post->views }} Views | {{ $post->comments->count() }} Reply</span>
            </div>

            <hr>
            <div class="comment-form mt-4">
                <h4>Add a Comment</h4>
                @if(session()->has('user_id'))
                    <form action="{{ route('forum.comment', $post) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Add a comment" required></textarea>
                        </div>
                        <button type="submit" class="btn">Submit Comment</button>
                    </form>
                @else
                    <p>Please <a href="{{ route('login') }}">login</a> to comment</p>
                @endif
            </div>

            <div class="post-replies">
                @foreach($post->comments as $comment)
                    <div class="reply">
                        <div class="post-header">
                            <div class="post-author">
                                <img src="https://i.pinimg.com/originals/f1/0f/f7/f10ff70a7155e5ab666bcdd1b45b726d.jpg" alt="Photo Profile">
                    
                                <span>{{ $comment->user->name }}</span>
                            </div>
                            <span class="post-date">{{ $comment->created_at->format('d F Y') }}</span>
                        </div>
                        <div class="post-content">
                            <p>{{ $comment->content }}</p>
                        </div>
                        <div class="review-actions">
                            <span class="fa fa-thumbs-up"></span><span>0</span>
                            <span class="fa fa-thumbs-down"></span><span>0</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 

@extends('layouts.app')

@section('title', 'Login - ClimateNow')

@section('styles')
<style>
    body {
        font-family: 'Lexend';
        background-color: rgb(242, 252, 255);
    }

    .main-content {
        width: 100%;
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        min-height: calc(100vh - 200px);
    }

    .login-container {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 15px;
        font-family: 'Lexend';
    }

    .form-control:hover {
        border-color: black;
    }

    .btn-logins {
        width: 50%;
        background-color: #007bff;
        color: white;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: 600;
        border: 1px solid transparent;
        border-radius: 5px;
        font-family: 'Lexend';
        margin: 20px auto;
        display: block;
    }

    .btn-logins:hover {
        border-color: black;
    }

    .footer-links {
        text-align: center;
        margin-top: 15px;
    }

    .footer-links a {
        color: black;
        text-decoration: none;
        display: block;
        margin: 10px 0;
        font-weight: 600;
    }

    .footer-links a:hover {
        color: blue;
    }

    .social-login {
        text-align: center;
        margin-top: 20px;
    }

    .social-btn {
        width: 50%;
        padding: 10px 0;
        margin: 5px 3px;
        font-size: 18px;
        border: 1px solid transparent;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-facebook {
        background-color: #007bff;
        color: white;
    }

    .btn-google {
        background-color: #e8e8e8;
        color: black;
    }

    @media only screen and (max-width: 450px) {
        .main-content {
            max-width: 400px;
            margin: 0;
        }

        .form-control, .btn-login, .social-btn {
            font-size: 14px;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content" style="padding-top: 120px !important;">
    <div class="login-container">
        <h2 class="text-center mb-4">WELCOME TO CLIMATENOW! <i class="fas fa-fist-raised"></i></h2>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="email" 
                       class="form-control" 
                       name="email" 
                       placeholder="Email"
                       value="{{ old('email') }}" 
                       required>
            </div>
            <div class="mb-3">
                <input type="password" 
                       class="form-control" 
                       name="password" 
                       placeholder="Password" 
                       required>
            </div>
            <div class="form-check mb-3 text-start">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Save My Account Info</label>
            </div>
            <button type="submit" class="btn btn-logins">Log In</button>
        </form>
        <div class="footer-links">
            <a href="#">Help</a>
            <a href="{{ route('register') }}">Don't have an account? Sign up Now!</a>
            <a href="#">Forgot Password?</a>
        </div>
    </div>
</div>
@endsection 
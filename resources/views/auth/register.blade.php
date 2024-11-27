@extends('layouts.app')

@section('title', 'Register - ClimateNow')

@section('styles')
<style>
    body {
        font-family: 'Lexend';
        background-color: rgb(242, 252, 255);
        margin-top: 20px;
    }

    .main-content {
        width: 100%;
        max-width: 600px;
        margin: 30px auto;
        padding: 20px;
        min-height: calc(100vh - 200px);
    }

    .register-container {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        margin-bottom: 5px;
        margin-top: 5px;
        font-weight: bold;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        font-family: 'Lexend';
    }

    .form-control:hover {
        border-color: black;
    }

    .btn-register {
        width: 50%;
        background-color: #007bff;
        color: white;
        padding: 12px;
        font-size: 18px;
        border: 1px solid transparent;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 30px auto;
        font-family: 'Lexend';
    }

    .btn-register:hover {
        border-color: black;
    }

    .footer-links {
        text-align: center;
        margin-top: 20px;
    }

    .footer-links a {
        color: black;
        text-decoration: none;
        font-weight: 600;
    }

    .footer-links a:hover {
        color: blue;
    }

    @media only screen and (max-width: 450px) {
        .main-content {
            max-width: 400px;
            margin: 0;
        }

        .form-control {
            font-size: 14px;
        }

        .btn-register {
            font-size: 14px;
        }

        .footer-links {
            font-size: 14px;
        }
    }
</style>
@endsection

@section('content')
<div class="main-content" style="padding-top: 100px !important;">
    <div class="register-container" >
        <div class="header">
            <h2>Create Your Account <i class="fas fa-user-plus"></i></h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror"
                       name="name" 
                       value="{{ old('name') }}"
                       required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" 
                       value="{{ old('email') }}"
                       required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" 
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" 
                       required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" 
                       class="form-control"
                       name="password_confirmation" 
                       required>
            </div>

            <button type="submit" class="btn-register">Create Account</button>
        </form>

        <div class="footer-links">
            <a href="{{ route('login') }}">Already have an account? Log in</a>
        </div>
    </div>
</div>
@endsection 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Climate Now!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #28a745;
            color: white;
        }

        .navbar-brand, .nav-link {
            color: white !important;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-container {
            background-color: #28a745;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            color: white;
        }

        .form-control {
            border-radius: 20px;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .btn-register {
            background-color: white;
            color: #28a745;
            font-weight: bold;
            border-radius: 20px;
            padding: 10px;
            width: 100%;
            border: none;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background-color: #218838;
            color: white;
        }

        .footer-links {
            margin-top: 20px;
            text-align: center;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 0.9em;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CLIMATENOW! <i class="fas fa-globe"></i></a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-ellipsis-v"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="register-container">
            <h2 class="text-center mb-4">Create Your Account <i class="fas fa-user-plus"></i></h2>
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" 
                           name="username" 
                           class="form-control @error('username') is-invalid @enderror" 
                           value="{{ old('username') }}"
                           placeholder="Enter your username" 
                           required>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           name="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Enter your password" 
                           required>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           class="form-control"
                           placeholder="Confirm your password" 
                           required>
                </div>

                <button type="submit" class="btn btn-register">Create Account</button>
            </form>

            <div class="footer-links">
                <a href="">Already have an account? Log in</a>
            </div>
        </div>
    </div>
</body>
</html> 
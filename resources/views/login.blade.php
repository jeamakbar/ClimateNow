<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Climate Now!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #28a745;
            padding: 15px 0;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .nav-link {
            color: white !important;
            margin: 0 10px;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background-color: #28a745;
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 20px;
            padding: 10px 15px;
            border: none;
            margin-bottom: 15px;
        }

        .form-check-label {
            color: white;
        }

        .btn-primary {
            background-color: white;
            color: #28a745;
            border: none;
            border-radius: 20px;
            padding: 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
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

        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-check-input {
            margin-right: 5px;
        }

        .form-check-input:checked {
            background-color: #28a745;
            border-color: #28a745;
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

    <!-- Main Content with Login Container Centered -->
    <div class="main-content">
        <div class="login-container">
            <h2>WELCOME TO CLIMATENOW! <i class="fas fa-fist-raised"></i></h2>
            
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
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-check mb-3 text-start">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Save My Account Info</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log In</button>
            </form>
            <div class="footer-links">
                <a href="#">Help</a>
                <a href="">Don't have an account? Sign in Now!</a>
                <a href="#">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
</html> 
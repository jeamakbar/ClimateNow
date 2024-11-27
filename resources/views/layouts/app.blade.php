<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ClimateNow')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Lexend', sans-serif;
            background-color: #f0f8f8;
        }

        .navbar {
            background-color: #04738b;
            padding: 15px 0;
        }

        .circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            background-color: white;
            padding: 5px;
        }

        .circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            font-weight: 600;
        }

        .nav-link.active {
            font-weight: 800;
        }

        .btn-login {
            background-color: white;
            border: 0;
            color: black;
            font-size: 15px;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 20px;
        }

        .btn-login:hover {
            background-color: black;
            color: white;
        }

        .content {
            flex: 1;
        }

        footer {
            background-color: #04738b;
            color: white;
            padding: 20px 0;
        }

        .fab {
            margin: 0 10px;
            cursor: pointer;
        }

        @media (max-width: 1200px) {
            .sidebar {
                background-color: rgba(4, 115, 139, 0.6);
                backdrop-filter: blur(10px);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <a href="/">
                        <div class="circle">
                            <img src="/images/logo.png" alt="Logo">
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a class="navbar-brand text-white" href="/">CLIMATENOW!</a>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="sidebar offcanvas offcanvas-end" id="offcanvasNavbar">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-white">CLIMATENOW!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column flex-lg-row">
                    <ul class="navbar-nav justify-content-md-start justify-content-lg-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('education*') ? 'active' : '' }}" href="/education">EDUKASI</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('events*') ? 'active' : '' }}" href="/events">EVENT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('calculator*') ? 'active' : '' }}" href="/calculator">KALKULATOR</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('forum*') ? 'active' : '' }}" href="/forum">FORUM</a>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-center flex-lg-row align-items-center gap-3">
                        @if(session('user_id'))
                            <a href="/profile" class="nav-link">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-login">LOGOUT</button>
                            </form>
                        @else
                            <a href="/login">
                                <button class="btn-login">LOGIN</button>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="content">
        @yield('content')
    </div>

    <footer class="text-white mt-5">
        <div class="footer-content py-3">
            <div class="text-center mb-1">
                <i class="fab fa-instagram"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-whatsapp"></i>
            </div>
            <div class="text-center mt-1">
                <p class="mb-0">© 2024 CLIMATENOW. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html> 
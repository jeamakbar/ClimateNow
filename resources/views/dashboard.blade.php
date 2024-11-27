<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClimateNow Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .sidebar {
            background-color: #28a745;
            height: 100vh;
            color: white;
            padding-top: 20px;
            position: fixed;
            width: 250px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
        }
        .sidebar a:hover {
            background-color: #218838;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
        .header {
            background-color: #28a745;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .stats-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-primary:hover {
            background-color: #218838;
            border-color: #218838;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">ClimateNow</h3>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home me-2"></i> Home</a>
        <a href="{{ route('profile') }}"><i class="fas fa-user me-2"></i> Profile</a>
        <a href="{{ route('programs') }}"><i class="fas fa-project-diagram me-2"></i> Programs</a>
        <a href="{{ route('content') }}"><i class="fas fa-file-alt me-2"></i> Content</a>
        <a href="{{ route('forum') }}"><i class="fas fa-comments me-2"></i> Forum</a>
        <a href="{{ route('reports') }}"><i class="fas fa-chart-bar me-2"></i> Reports</a>
        <a href="{{ route('settings') }}"><i class="fas fa-cog me-2"></i> Settings</a>
        <a href="{{ route('logout') }}" 
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="fas fa-sign-out-alt me-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Header -->
        <div class="header">
            <h4>Dashboard</h4>
            <div>
                <span class="me-3">Welcome, {{ Auth::user()->username }}!</span>
                <span><i class="fas fa-bell"></i></span>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="row my-4">
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h5>Programs Joined</h5>
                    <p>{{ $programsCount ?? 5 }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h5>Upcoming Webinars</h5>
                    <p>{{ $webinarsCount ?? 2 }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h5>Forum Contributions</h5>
                    <p>{{ $contributionsCount ?? 12 }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card text-center">
                    <h5>Badges Earned</h5>
                    <p>{{ $badgesCount ?? 8 }}</p>
                </div>
            </div>
        </div>

        <!-- Recommended Programs Section -->
        <h5>Recommended Programs</h5>
        <div class="row">
            @foreach($recommendedPrograms ?? [] as $program)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $program->image_url ?? 'https://via.placeholder.com/150' }}" 
                             class="card-img-top" alt="{{ $program->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $program->title }}</h5>
                            <p class="card-text">{{ $program->description }}</p>
                            <a href="{{ route('programs.show', $program->id) }}" 
                               class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if(empty($recommendedPrograms))
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Program Image">
                        <div class="card-body">
                            <h5 class="card-title">Sustainable Energy</h5>
                            <p class="card-text">Learn about renewable energy sources and their importance.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Program Image">
                        <div class="card-body">
                            <h5 class="card-title">Climate Change 101</h5>
                            <p class="card-text">Introduction to the causes and impacts of climate change.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Program Image">
                        <div class="card-body">
                            <h5 class="card-title">Waste Management</h5>
                            <p class="card-text">Discover ways to reduce, reuse, and recycle effectively.</p>
                            <a href="#" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
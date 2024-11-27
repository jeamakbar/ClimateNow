<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    AuthController,
    NewsController,
    EducationController,
    EventController,
    CalculatorController,
    ForumController,
    ProfileController,
    MonitoringController,
    SocialMediaController,
    AdminController
};

// Home & Global Features
Route::get('/', [HomeController::class, 'index'])->name('home');
// view: home/index.blade.php

// Theme Toggle
Route::post('/theme/toggle', [HomeController::class, 'toggleTheme'])->name('theme.toggle');

// Auth Routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
// view: auth/login.blade.php
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
// view: auth/register.blade.php
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// News Routes
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news.index');
    // view: news/index.blade.php
    Route::get('/{news}', [NewsController::class, 'show'])->name('news.show');
    // view: news/show.blade.php
    Route::get('/create', [NewsController::class, 'create'])->name('news.create');
    // view: news/create.blade.php
    Route::post('/', [NewsController::class, 'store'])->name('news.store');
});

// Education Routes
Route::prefix('education')->group(function () {
    Route::get('/', [EducationController::class, 'index'])->name('education.index');
    // view: education/index.blade.php
    Route::post('/', [EducationController::class, 'store'])->name('education.store');
    // view: education/create.blade.php (admin only)
    Route::get('/{material}', [EducationController::class, 'show'])->name('education.show');
});

// Event Routes
Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    // view: events/index.blade.php
    Route::get('/create', [EventController::class, 'create'])->name('events.create');
    // view: events/create.blade.php
    Route::post('/', [EventController::class, 'store'])->name('events.store');
    Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
    // view: events/show.blade.php
    Route::post('/{event}/join', [EventController::class, 'join'])->name('events.join');
    Route::post('/{event}/rate', [EventController::class, 'rate'])->name('events.rate');
});

// Calculator Routes
Route::prefix('calculator')->group(function () {
    Route::get('/', [CalculatorController::class, 'index'])->name('calculator.index');
    // view: calculator/index.blade.php
    Route::post('/calculator', [CalculatorController::class, 'calculate'])->name('calculator.calculate');
    Route::get('/dashboard', [CalculatorController::class, 'dashboard'])->name('calculator.dashboard');
    // view: calculator/dashboard.blade.php
});

// Forum Routes
Route::prefix('forum')->group(function () {
    // Public routes first
    Route::get('/', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/trending', [ForumController::class, 'trending'])->name('forum.trending');
    
    // Protected routes after
        Route::post('/', [ForumController::class, 'store'])->name('forum.store');
        Route::post('/{post}/react', [ForumController::class, 'react'])->name('forum.react');
        Route::post('/{post}/comment', [ForumController::class, 'comment'])->name('forum.comment');
    
    
    // This route needs to be last to avoid conflicts
    Route::get('/{post}', [ForumController::class, 'show'])->name('forum.show');
    Route::put('/forum/{post}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('/forum/{post}', [ForumController::class, 'destroy'])->name('forum.destroy');
});

// Profile Routes
Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('profile.show');
    // view: profile/show.blade.php
    Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/stats', [ProfileController::class, 'getStats'])->name('profile.stats');
});

// // Monitoring Routes
// Route::prefix('monitoring')->group(function () {
//     Route::get('/', [MonitoringController::class, 'index'])->name('monitoring.index');
//     // view: monitoring/index.blade.php
//     Route::post('/', [MonitoringController::class, 'store'])->name('monitoring.store');
//     Route::get('/dashboard', [MonitoringController::class, 'dashboard'])->name('monitoring.dashboard');
//     // view: monitoring/dashboard.blade.php
// });

// // Social Media Routes
// Route::prefix('social-media')->group(function () {
//     Route::get('/', [SocialMediaController::class, 'getLinks'])->name('social-media.links');
//     Route::post('/update', [SocialMediaController::class, 'update'])->name('social-media.update');
// });

// // Middleware Group untuk Routes yang Membutuhkan Login
// Route::middleware('auth.simple')->group(function () {
//     // Routes yang membutuhkan login
//     Route::post('/events/{event}/join', [EventController::class, 'join']);
//     Route::post('/events/{event}/rate', [EventController::class, 'rate']);
//     Route::post('/forum', [ForumController::class, 'store']);
//     Route::post('/forum/{post}/react', [ForumController::class, 'react']);
//     Route::post('/forum/{post}/comment', [ForumController::class, 'comment']);
//     Route::post('/calculator/calculate', [CalculatorController::class, 'calculate']);
//     Route::get('/profile', [ProfileController::class, 'show']);
//     Route::post('/profile/update', [ProfileController::class, 'update']);
// });

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    // Education Management
    Route::post('/education', [EducationController::class, 'store'])->name('education.store');
    Route::get('/education/{id}/edit', [AdminController::class, 'editEducation'])->name('admin.education.edit');
    Route::put('/education/{id}', [AdminController::class, 'updateEducation'])->name('admin.education.update');
    Route::delete('/education/{id}', [AdminController::class, 'deleteEducation'])->name('admin.education.delete');
    
    // Event Management
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('admin.events.update');
    Route::delete('/events/{id}', [AdminController::class, 'deleteEvent'])->name('admin.events.delete');
});
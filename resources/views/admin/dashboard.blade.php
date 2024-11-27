@extends('layouts.app')

@section('title', 'Admin Dashboard - ClimateNow')

@section('styles')
<style>
    body {
        background-color: rgb(242, 252, 255);
        font-family: 'Lexend';
    }

    .admin-container {
        max-width: 1200px;
        margin: 100px auto;
        padding: 20px;
    }

    .admin-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .nav-tabs {
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        background-color: white;
        border-radius: 10px 10px 0 0;
    }

    .nav-tabs .nav-link {
        color: #000000 !important;
        font-weight: 500;
        border: none;
        padding: 10px 20px;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        color: #609695 !important;
        background-color: rgba(96, 150, 149, 0.1);
        border-bottom: 2px solid #609695;
    }

    .nav-tabs .nav-link.active {
        color: #609695 !important;
        background-color: rgba(96, 150, 149, 0.1);
        border-bottom: 2px solid #609695;
        font-weight: 600;
    }

    .btn-admin {
        background-color: #609695;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .table th {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="admin-container">
    <ul class="nav nav-tabs" role="tablist" style="color:black;">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#users">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#education">Education</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#events">Events</a>
        </li>
    </ul>

    <div class="tab-content">
        <!-- Users Tab -->
        <div id="users" class="tab-pane active">
            <div class="admin-card">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Users Management</h3>
                    <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }})">Edit</button>
                                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Education Tab -->
        <div id="education" class="tab-pane fade">
            <div class="admin-card">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Education Materials</h3>
                    <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#addEducationModal">Add Material</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($educationPosts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category }}</td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.education.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('admin.education.delete', $post->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Events Tab -->
        <div id="events" class="tab-pane fade">
            <div class="admin-card">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Events Management</h3>
                    <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#addEventModal">Add Event</button>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Date</th>
                                <th>Location</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>{{ $event->location }}</td>
                                <td>
                                    <button class="btn btn-sm btn-primary" onclick="editEvent({{ $event->id }})">Edit</button>
                                    <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.modals.user')
@include('admin.modals.education')
@include('admin.modals.event')
@endsection 
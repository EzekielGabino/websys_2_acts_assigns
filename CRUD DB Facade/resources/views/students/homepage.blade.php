@extends('layouts.masters')

@section('content')

@php
    $student = Auth::user();
@endphp

<div class="page-container">
    <div class="card">

        <h1>Student Profile</h1>

        <table class="profile-table">
            <tr><th>Student ID</th><td>{{ $student->id }}</td></tr>
            <tr><th>Last Name</th><td>{{ $student->lname }}</td></tr>
            <tr><th>First Name</th><td>{{ $student->fname }}</td></tr>
            <tr><th>Middle Name</th><td>{{ $student->Mname }}</td></tr>
            <tr><th>Username</th><td>{{ $student->username }}</td></tr>
            <tr><th>Email</th><td>{{ $student->email }}</td></tr>
            <tr><th>Age</th><td>{{ $student->age }}</td></tr>
            <tr><th>Date of Birth</th><td>{{ $student->dob }}</td></tr>
            <tr><th>Created At</th><td>{{ $student->created_at }}</td></tr>
            <tr><th>Updated At</th><td>{{ $student->updated_at }}</td></tr>
        </table>

        <br>

        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
            Update Profile
        </a>

        <form action="{{ route('students.logout') }}" method="post" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>

    </div>
</div>

@endsection
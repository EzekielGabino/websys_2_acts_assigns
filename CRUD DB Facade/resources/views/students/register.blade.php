@extends('layouts.login&registration')

@section('content')

<div class="form-container">
    <div class="form-box">

        <h2>Register</h2>

        <form action="{{ route('students.store') }}" method="post">
            @csrf

            @if (session('success'))
                <p class="success-message">{{ session('success') }}</p>
            @endif

            <label>Last Name:</label>
            <input type="text" name="lname" value="{{ old('lname') }}">
            @error('lname')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>First Name:</label>
            <input type="text" name="fname" value="{{ old('fname') }}">
            @error('fname')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Middle Initial:</label>
            <input type="text" name="Mname" value="{{ old('Mname') }}">
            @error('Mname')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Username:</label>
            <input type="text" name="username" value="{{ old('username') }}">
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Email:</label>
            <input type="text" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Age:</label>
            <input type="text" name="age" value="{{ old('age') }}">
            @error('age')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="{{ old('dob') }}">
            @error('dob')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="gender-group">
                <label>Gender:</label><br>
                <label>
                    <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }}> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }}> Female
                </label>
            </div>
            @error('gender')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Password:</label>
            <input type="password" name="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation">

            <button type="submit">Register</button>
        </form>

        <a class="link" href="{{ route('students.loginview') }}">
            Already have an account?
        </a>

    </div>
</div>

@endsection
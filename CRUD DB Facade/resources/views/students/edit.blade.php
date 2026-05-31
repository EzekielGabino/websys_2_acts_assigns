@extends('layouts.masters')

@section('content')

<div class="page-container">
    <div class="card">

        <h1>Edit Profile</h1>

        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <form action="{{ route('students.update', $students->id) }}" method="post">
            @csrf
            @method('PUT')

            <label>Last Name:</label>
            <input type="text" name="lname" value="{{ $students->lname }}">
            @error('lname') <div class="error">{{ $message }}</div> @enderror

            <label>First Name:</label>
            <input type="text" name="fname" value="{{ $students->fname }}">
            @error('fname') <div class="error">{{ $message }}</div> @enderror

            <label>Middle Initial:</label>
            <input type="text" name="Mname" value="{{ $students->Mname }}">
            @error('Mname') <div class="error">{{ $message }}</div> @enderror

            <label>Username:</label>
            <input type="text" name="username" value="{{ $students->username }}">
            @error('username') <div class="error">{{ $message }}</div> @enderror

            <label>Email:</label>
            <input type="text" name="email" value="{{ $students->email }}">
            @error('email') <div class="error">{{ $message }}</div> @enderror

            <label>Age:</label>
            <input type="text" name="age" value="{{ $students->age }}">
            @error('age') <div class="error">{{ $message }}</div> @enderror

            <label>Date of Birth:</label>
            <input type="date" name="dob" value="{{ $students->dob }}">
            @error('dob') <div class="error">{{ $message }}</div> @enderror

            <div class="radio-group">
                <label>Gender:</label><br>
                <label>
                    <input type="radio" name="gender" value="Male" {{ $students->gender == 'Male' ? 'checked' : '' }}>
                    Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female" {{ $students->gender == 'Female' ? 'checked' : '' }}>
                    Female
                </label>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>

        </form>

    </div>
</div>

@endsection
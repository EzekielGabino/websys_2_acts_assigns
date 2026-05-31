@extends('layouts.login&registration')

@section('content')

<div class="form-container">
    <div class="form-box">

        <h2>Login</h2>

        <form action="{{ route('students.logins') }}" method="post">
            @csrf
            
            <label>Username:</label>
            <input type="text" name="username" value="{{ old('username') }}">
            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Password:</label>
            <input type="password" name="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
            
            <button type="submit">Login</button>
        </form>

        <a href="{{ route('students.register') }}">Register?</a>

    </div>
</div>

@endsection
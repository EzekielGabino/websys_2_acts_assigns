{{-- resources/views/students/create.blade.php --}}
@extends('layouts.master')

@section('content')

<div class="card main-card p-5">

    <h2 class="page-title mb-4">Add Student</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('students.add') }}"
          method="post"
          enctype="multipart/form-data">

        @csrf

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Last Name</label>
                <input type="text"
                       name="lname"
                       class="form-control"
                       value="{{ old('lname') }}">

                @error('lname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>First Name</label>
                <input type="text"
                       name="fname"
                       class="form-control"
                       value="{{ old('fname') }}">

                @error('fname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text"
                       name="mname"
                       class="form-control"
                       value="{{ old('mname') }}">

                @error('mname')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       value="{{ old('course') }}">

                @error('course')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label>Year Level</label>
                <input type="text"
                       name="yearlevel"
                       class="form-control"
                       value="{{ old('yearlevel') }}">

                @error('yearlevel')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-12 mb-4">
                <label>Student Picture</label>
                <input type="file"
                       name="pic"
                       class="form-control">

                @error('pic')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Add Student
            </button>

            <a href="{{ route('students.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
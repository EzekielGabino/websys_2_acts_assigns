{{-- resources/views/students/edit.blade.php --}}
@extends('layouts.master')

@section('content')

<div class="card main-card p-5">

    <h2 class="page-title mb-4">Edit Student</h2>

    <form action="{{ route('students.update', $student->id) }}"
          method="post"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="text-center mb-4">
            <img src="{{ asset('images/'.$student->pic) }}"
                 alt="photo"
                 class="student-image">
        </div>

        <div class="row">

            <div class="col-md-4 mb-3">
                <label>Last Name</label>
                <input type="text"
                       name="lname"
                       class="form-control"
                       value="{{ $student->lname }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>First Name</label>
                <input type="text"
                       name="fname"
                       class="form-control"
                       value="{{ $student->fname }}">
            </div>

            <div class="col-md-4 mb-3">
                <label>Middle Name</label>
                <input type="text"
                       name="mname"
                       class="form-control"
                       value="{{ $student->mname }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Course</label>
                <input type="text"
                       name="course"
                       class="form-control"
                       value="{{ $student->course }}">
            </div>

            <div class="col-md-6 mb-3">
                <label>Year Level</label>
                <input type="text"
                       name="yearlevel"
                       class="form-control"
                       value="{{ $student->yearlevel }}">
            </div>

            <div class="col-12 mb-4">
                <label>Change Picture</label>
                <input type="file"
                       name="pic"
                       class="form-control">
            </div>

        </div>

        <div class="d-flex gap-2">
            <button type="submit"
                    class="btn btn-success">
                Update Student
            </button>

            <a href="{{ route('students.index') }}"
               class="btn btn-secondary">
                Back
            </a>
        </div>

    </form>

</div>

@endsection
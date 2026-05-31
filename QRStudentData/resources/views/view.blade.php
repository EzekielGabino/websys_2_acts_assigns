{{-- resources/views/students/view.blade.php --}}
@extends('layouts.master')

@section('content')

<div class="card main-card p-5 text-center">

    <div class="mb-4">
        <img src="{{ asset('images/'.$student->pic) }}"
             alt="photo"
             class="student-image">
    </div>

    <h2 class="page-title">
        {{ $student->lname }},
        {{ $student->fname }}
        {{ $student->mname }}
    </h2>

    <p class="fs-5 mt-3">
        <strong>Course:</strong> {{ $student->course }}
    </p>

    <p class="fs-5">
        <strong>Year Level:</strong> {{ $student->yearlevel }}
    </p>

    <div class="my-4">
        {!! $qr !!}
    </div>

    <a href="{{ route('students.index') }}"
       class="btn btn-primary">
        Back
    </a>

</div>

@endsection
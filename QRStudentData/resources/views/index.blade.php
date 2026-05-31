{{-- resources/views/students/index.blade.php --}}
@extends('layouts.master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title">Student List</h1>

    <a href="{{ route('students.create') }}" class="btn btn-primary">
        + Add Student
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row g-4">

    @foreach ($students as $student)

        <div class="col-md-4">
            <div class="card student-card p-4 text-center h-100">

                <div class="mb-3">
                    <img src="{{ asset('images/'.$student->pic) }}"
                         alt="photo"
                         class="student-image">
                </div>

                <h4>
                    {{ $student->lname }},
                    {{ $student->fname }}
                    {{ $student->mname }}
                </h4>

                <p class="text-muted mb-1">
                    {{ $student->course }}
                </p>

                <p class="text-muted">
                    {{ $student->yearlevel }}
                </p>

                <div class="mb-3">
                    {!! $student->qr !!}
                </div>

                <div class="d-flex justify-content-center gap-2">

                    <a href="{{ route('students.view', $student->id) }}"
                        class="btn btn-info text-white">
                        View
                    </a>

                    <a href="{{ route('students.edit.create', $student->id) }}"
                        class="btn btn-warning text-white">
                        Edit
                    </a>

                    <form action="{{ route('students.delete', $student->id) }}"
                          method="post">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="btn btn-danger">
                            Delete
                        </button>
                    </form>

                </div>

            </div>
        </div>

    @endforeach

</div>

@endsection

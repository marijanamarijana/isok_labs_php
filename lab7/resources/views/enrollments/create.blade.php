@extends('layout')

@section('content')
    <form method="POST" action="{{ route('enrollments.store') }}">
        @csrf
        <input type="hidden" name="course_id" value="{{ $course->id }}">

        <input name="student_name" placeholder="Student name"><br>
        <input type="number" name="seats_requested" value="1"><br>

        <button>Enroll</button>
    </form>
@endsection

@extends('layout')

@section('content')
    <form method="POST" action="{{ route('courses.update', $course) }}">
        @csrf @method('PUT')
        @include('courses.form')
        <button>Update</button>
    </form>
@endsection


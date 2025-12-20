@extends('layout')

@section('content')
    <form method="POST" action="{{ route('courses.store') }}">
        @csrf
        @include('courses.form')
        <button>Create</button>
    </form>
@endsection


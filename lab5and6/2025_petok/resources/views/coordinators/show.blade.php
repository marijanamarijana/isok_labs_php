@extends('layout')

@section('content')
    <h1>{{ $coordinator->name }}'s Details</h1>

    <table border="1">
        <tr>
            <th>Name</th>
            <td>{{ $coordinator->name }}</td>
        </tr>
        <tr>
            <th>Surname</th>
            <td>{{ $coordinator->surname }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $coordinator->email }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $coordinator->phone }}</td>
        </tr>
    </table>

    <h2>Events</h2>
    <table border="1">
        <thead>
        <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Type of Event</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($coordinator->events as $ev)
            <tr>
                <td>
                    <a href="{{ route('events.show', $ev->id) }}">
                        {{ $ev->name }}
                    </a>
                </td>
                <td>{{ $ev->description }}</td>
                <td>{{ $ev->date }}</td>
                <td>{{ ucfirst($ev->type->value) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('coordinators.index') }}">Back to Coordinator</a>
@endsection

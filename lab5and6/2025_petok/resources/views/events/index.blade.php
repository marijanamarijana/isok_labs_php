@extends('layout')

@section('content')
<h1>Events</h1>

<form method="GET" action="{{ route('events.index') }}">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search...">
    <button type="submit">Search</button>
</form>


<a href="{{ route('events.create') }}">Create Event</a>

<table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Type</th>
        <th>Event Coordinator</th>
        <th>Actions</th>
    </tr>

    @foreach ($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
           <td>{!! nl2br(e($event->description)) !!}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->type }}</td>
            <td>
                <a href="{{ route('coordinators.show', $event->coordinator->id) }}">
                {{ $event->coordinator->name }}  {{$event->coordinator->surname}}
                </a>
            </td>
            <td>
                <a href="{{ route('events.show', $event->id) }}">View</a>
                <a href="{{ route('events.edit', $event->id) }}">Edit</a>

                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $events->links() }}
@endsection

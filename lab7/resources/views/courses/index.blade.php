@extends('layout')

@section('content')
    <form method="GET">
        <input type="text" name="search" placeholder="Search title" value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table>
        <tr>
            <th>Title</th>
            <th>Level</th>
            <th>Start</th>
            <th>Seats</th>
            <th>Actions</th>
        </tr>

        @foreach ($courses as $course)
            <tr>
                <td>{{ $course->title }}</td>
                <td>{{ $course->level }}</td>
                <td>{{ $course->start_date }}</td>
                <td>{{ $course->seats }}</td>
                <td>
                    <a href="{{ route('courses.show', $course) }}">View</a>
                    <a href="{{ route('courses.edit', $course) }}">Edit</a>
                    <form method="POST" action="{{ route('courses.destroy', $course) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

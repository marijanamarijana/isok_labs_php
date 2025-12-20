@extends('layout')

@section('content')
    <h2>{{ $course->title }}</h2>

    <p>{{ $course->summary }}</p>
    <p>Level: {{ $course->level }}</p>
    <p>Seats left: {{ $course->seats }}</p>

    <a href="{{ route('enrollments.create', $course) }}">Enroll Student</a>

    <h3>Enrollments</h3>
    <table>
        <tr>
            <th>Student</th>
            <th>Seats</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach ($course->enrollments as $enrollment)
            <tr>
                <td>{{ $enrollment->student_name }}</td>
                <td>{{ $enrollment->seats_requested }}</td>
                <td>{{ $enrollment->status }}</td>
                <td>
                    @if ($enrollment->status === 'pending')
                        <form method="POST" action="{{ route('enrollments.approve', $enrollment) }}">
                            @csrf @method('PUT')
                            <button>Approve</button>
                        </form>
                    @endif

                    @if ($enrollment->status === 'approved')
                        <form method="POST" action="{{ route('enrollments.drop', $enrollment) }}">
                            @csrf @method('PUT')
                            <button>Drop</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
@endsection


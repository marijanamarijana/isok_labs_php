@extends('layout')

@section('content')
<h1>Coordinators</h1>

<a href="{{ route('coordinators.create') }}">Create Coordinator</a>

<table border="1" cellpadding="5">
    <tr>
       <th>Name</th> <th>Surname</th> <th>Email</th> <th>Phone</th> <th>Actions</th>
    </tr>

    @foreach ($coordinators as $org)
        <tr>
            <td>{{ $org->name }}</td>
            <td>{{ $org->surname }}</td>
            <td>{{ $org->email }}</td>
            <td>{{ $org->phone }}</td>
            <td>
                <a href="{{ route('coordinators.show', $org->id) }}">View</a>
                <a href="{{ route('coordinators.edit', $org->id) }}">Edit</a>

                <form action="{{ route('coordinators.destroy', $org->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

{{ $coordinators->links() }}
@endsection

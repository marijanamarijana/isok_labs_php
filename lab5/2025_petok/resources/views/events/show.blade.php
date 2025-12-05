<h1>{{ $event->name }} Details</h1>

<p><strong>Description:</strong> {{ $event->description }}</p>
<p><strong>Type:</strong> {{ $event->type }}</p>
<p><strong>Date:</strong> {{ $event->date }}</p>

<p><strong>Coordinator:</strong>  <a href="{{ route('coordinators.show', $event->coordinator->id) }}">
        {{ $event->coordinator->name }}  {{$event->coordinator->surname}}
    </a></p>

<a href="{{ route('events.edit', $event->id) }}">Edit</a>
<form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button>Delete</button>
</form>

<a href="{{ route('events.index') }}">Back to Events</a>

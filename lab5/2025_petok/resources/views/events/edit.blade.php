<h1>Edit Event</h1>

<form method="POST" action="{{ route('events.update', $event) }}">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Event Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $event->name) }}">
        @error('name')
        <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description', $event->description) }}</textarea>
        @error('description')
        <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="{{ old('date', $event->date) }}">
        @error('date')
        <div style="color:red">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="type">Type:</label>
        <input type="text" name="type" id="type" value="{{ old('type', $event->type) }}">
        @error('type')
        <div style="color:red">{{ $message }}</div>
        @enderror
    </div>



    <div>
        <label for=coordinator_id> Coordinator</label>
    <select name="coordinator_id" id="coordinator_id">
        <option value="">Select Coordinator</option>
        @foreach ($coordinators as $coord)
            <option value="{{ $coord->id }}" {{ old('$coordinator_id', $event->coordinator_id) == $coord->id ? 'selected' : '' }}>
                {{ $coord->name }} {{ $coord->surname }}
            </option>
        @endforeach
    </select><br>
    @error('coordinator_id')
        <small style="color:red">{{ $message }}</small><br>
        @enderror
    </div>

    <button type="submit">Update</button>
</form>

<a href="{{ route('events.index') }}">Back to Events</a>

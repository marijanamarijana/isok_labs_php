<h1>Edit Client</h1>

<form action="{{ route('coordinators.update', $coordinator->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name', $coordinator->name) }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" value="{{ old('surname', $coordinator->surname) }}">
        @error('surname')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $coordinator->email) }}">
        @error('email')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $coordinator->phone) }}">
        @error('phone')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">Update Coordinator</button>
    </div>
</form>

<a href="{{ route('coordinators.index') }}">Back to Coordinators</a>p

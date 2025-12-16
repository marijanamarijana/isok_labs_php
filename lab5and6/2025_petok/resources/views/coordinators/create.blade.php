<h1>Add new Coordinator</h1>

<form action="{{ route('coordinators.store') }}" method="POST">
    @csrf

    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" value="{{ old('surname') }}">
        @error('surname')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
        @error('phone')
        <div style="color: red;">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <button type="submit">Create Coordinator</button>
    </div>
</form>

<a href="{{ route('coordinators.index') }}">Back to Coordinators</a>p

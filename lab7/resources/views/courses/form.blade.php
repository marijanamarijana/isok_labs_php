<input name="title" placeholder="Title" value="{{ old('title', $course->title ?? '') }}"><br>
<textarea name="summary" placeholder="Summary">{{ old('summary', $course->summary ?? '') }}</textarea><br>

<select name="level">
    @foreach (['beginner','intermediate','advanced'] as $level)
        <option value="{{ $level }}"
            @selected(old('level', $course->level ?? '') === $level)>
            {{ ucfirst($level) }}
        </option>
    @endforeach
</select><br>

<input type="date" name="start_date" value="{{ old('start_date', $course->start_date ?? '') }}"><br>
<input type="number" name="seats" value="{{ old('seats', $course->seats ?? 1) }}"><br>

@error('*') <p class="error">{{ $message }}</p> @enderror

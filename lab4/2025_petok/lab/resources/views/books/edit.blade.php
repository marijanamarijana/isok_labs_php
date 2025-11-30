<h1>Create Book</h1>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Title</label><br>
    <input type="text" id="title" name="title" value="{{$book->title}}" required><br><br>

    <label for="author">Author</label><br>
    <input type="text" id="author" name="author" value="{{$book->author}}" required><br><br>

    <label for="published_year">Published Year</label><br>
    <input type="number" id="published_year" name="published_year" value="{{$book->published_year}}" required><br><br>

    <label for="ISBN">ISBN</label><br>
    <input type="number" id="ISBN" name="ISBN" value="{{$book->ISBN}}" required><br><br>

    <label for="genre">Genre</label><br>
    <input type="text" id="genre" name="genre" value="{{$book->genre}}" required><br><br>

    <label for="renter_name">Renter name</label><br>
    <input type="text" id="renter_name" name="renter_name" value="{{$book->renter_name}}"><br><br>

    <label for="start_date">Start date</label><br>
    <input type="date" id="start_date" name="start_date" value="{{$book->start_date}}"><br><br>

    <label for="end_date">End date</label><br>
    <input type="date" id="end_date" name="end_date" value="{{$book->end_date}}"><br><br>


    <button type="submit">Edit Book</button>
</form>

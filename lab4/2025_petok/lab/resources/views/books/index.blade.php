<div>
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Add Book</a>

@if($books->isEmpty())
    <p>No books found.</p>
@else
    <table border="1">
        <thead>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Published year</th>
            <th>ISBN</th>
            <th>Genre</th>
            <th>Renter's name</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_year }}</td>
                <td>{{ $book->ISBN }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->renter_name }}</td>
                <td>{{ $book->start_date }}</td>
                <td>{{ $book->end_date }}</td>

                <td>
                    <a href="{{ route('books.edit', $book->id) }}">Update</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Are you sure you want to delete this book?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
    </div>

<div>
<h2>All books: {{$count}}</h2>
    <h2>Rented books: {{$count_rented}}</h2>
</div>

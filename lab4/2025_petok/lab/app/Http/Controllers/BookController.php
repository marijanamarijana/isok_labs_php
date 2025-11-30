<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();
        $count = $books->count();
        $count_rented = $books->whereNotNull('renter_name')->count();

        return view('books/index', compact('books', 'count', 'count_rented'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        book::query()->create($request->all());
        return redirect()->route('books.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(book $book)
    {
        return view('books/edit', compact('book'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, book $book)
    {
        $book->update($request->all());
        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(book $book)
    {
       $book->delete();
        return redirect()->route('books.index');
    }
}

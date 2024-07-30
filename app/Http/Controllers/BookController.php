<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->paginate(5);
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required|exists:authors,id',
            'isbn' => 'required',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y')),
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'isbn' => 'required',
            'published_year' => 'required|digits:4|integer|min:1900|max:' . (date('Y'))
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
                         ->with('success', 'Book updated successfully.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
                         ->with('success', 'Book deleted successfully.');
    }
}

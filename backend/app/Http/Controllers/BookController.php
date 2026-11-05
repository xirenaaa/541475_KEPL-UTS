<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     */
    public function index()
    {
        $books = Book::all();

        return response()->json([
            'data' => $books,
        ]);
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'isbn'        => 'required|string|max:20|unique:books',
            'publisher'   => 'nullable|string|max:255',
            'year'        => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        $book = Book::create($validated);

        Log::info('Book created', [
            'action'  => 'book.store',
            'user_id' => $request->user()?->id,
            'user'    => $request->user()?->email,
            'book_id' => $book->id,
            'title'   => $book->title,
            'isbn'    => $book->isbn,
        ]);

        return response()->json([
            'message' => 'Book created successfully',
            'data'    => $book,
        ], 201);
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return response()->json([
            'data' => $book,
        ]);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'author'      => 'sometimes|required|string|max:255',
            'isbn'        => 'sometimes|required|string|max:20|unique:books,isbn,' . $book->id,
            'publisher'   => 'nullable|string|max:255',
            'year'        => 'nullable|integer|min:1000|max:' . (date('Y') + 1),
            'description' => 'nullable|string',
        ]);

        $book->update($validated);

        Log::info('Book updated', [
            'action'  => 'book.update',
            'user_id' => $request->user()?->id,
            'user'    => $request->user()?->email,
            'book_id' => $book->id,
            'changes' => array_keys($validated),
        ]);

        return response()->json([
            'message' => 'Book updated successfully',
            'data'    => $book,
        ]);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Request $request, Book $book)
    {
        $bookId    = $book->id;
        $bookTitle = $book->title;
        $book->delete();

        Log::warning('Book deleted', [
            'action'  => 'book.destroy',
            'user_id' => $request->user()?->id,
            'user'    => $request->user()?->email,
            'book_id' => $bookId,
            'title'   => $bookTitle,
        ]);

        return response()->json([
            'message' => 'Book deleted successfully',
        ]);
    }
}

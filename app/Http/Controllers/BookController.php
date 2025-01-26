<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return response()->json([
            'success' => true,
            'data' => $books,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1000|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:book_categories,id',
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.',
            'data' => $book,
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year_published' => 'required|integer|min:1000|max:' . date('Y'),
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:book_categories,id',
        ]);

        Book::where('id', $id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'publisher' => $request->publisher,
            'year_published' => $request->year_published,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully.',
            'data' => Book::all(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Book $Book, int $id)
    {
        $Book = Book::find($id);
        $Book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.',
        ]);
    }
}

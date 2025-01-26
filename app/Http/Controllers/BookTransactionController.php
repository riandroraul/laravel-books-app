<?php

namespace App\Http\Controllers;

use App\Models\BorrowingTransaction;
use Illuminate\Http\Request;

class BookTransactionController extends Controller
{

    public function borrowed()
    {

        $book = BorrowingTransaction::where('status', 'returned')->get();

        return response()->json([
            'success' => true,
            'message' => 'get returned book successfully.',
            'data' => $book,
        ], 201);
    }

    public function borrowing(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'user_id' => 'required|integer|exists:users,id',
            'borrow_date' => 'required',
            'status' => 'required',
        ]);

        $book = BorrowingTransaction::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.',
            'data' => $book,
        ], 201);
    }

    public function returned(Request $request, int $id)
    {

        $book = BorrowingTransaction::where('id', $id)->update(
            [
                'status' => 'returned',
                'return_date' => date('Y-m-d')
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Book returned successfully.',
            'data' => $book,
        ], 201);
    }
}

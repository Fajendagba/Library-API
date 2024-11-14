<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Book::query();

        // Apply filters
        if ($request->has('author')) {
            $query->where('author', 'like', '%' . $request->author . '%');
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Apply search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('author', 'like', '%' . $search . '%')
                  ->orWhere('isbn', 'like', '%' . $search . '%');
            });
        }

        $books = $query->paginate(10);

        return response()->json($books);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());

        return response()->json($book, 201);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());

        return response()->json($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'message' => 'Book deleted'
        ], 200);
    }
}

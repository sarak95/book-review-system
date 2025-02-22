<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    protected BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index(): JsonResponse
    {

        return response()->json($this->bookService->getAllBooks());
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = $this->bookService->createBook($request->validated());
        return response()->json($book, 201);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {
       $book = $this->bookService->updateBook($book->id, $request->validated());
       return response()->json($book);
    }

    public function destroy(Book $book): JsonResponse
    {
        $this->bookService->deleteBook($book->id);
        return response()->json(['message' => 'Book deleted successfully']);
    }

    public function attachTags(Request $request, Book $book): JsonResponse
    {

        $validated = $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $this->bookService->attachTagsToBook($book, $validated['tags']);

        return response()->json(['message' => 'Tags attached successfully']);
    }

    public function detachTag(Book $book, $tagId): JsonResponse
    {

        $this->bookService->detachTagFromBook($book, $tagId);

        return response()->json(['message' => 'Tag detached successfully']);
    }

    public function showWithTags(Book $book): JsonResponse
    {
        $bookWithTags = $this->bookService->getBookWithTags($book);

        return response()->json($bookWithTags);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BookController
 */
class BookController extends Controller
{
    /**
     * @var BookService
     */
    protected BookService $bookService;

    /**
     * @param BookService $bookService
     */
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    /**
     * Get all books.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(BookResource::collection($this->bookService->getAllBooks()));
    }

    /**
     * Store a new book.
     * @param BookRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(BookRequest $request): JsonResponse
    {
        $this->authorize('create', Book::class);

        $book = $this->bookService->createBook($request->validated());
        return response()->json(new BookResource($book), 201);
    }

    /**
     * Update an existing book.
     * @param BookRequest $request
     * @param Book $book
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        $this->authorize('update', $book);

        $book = $this->bookService->updateBook($book->id, $request->validated());
        return response()->json(new BookResource($book));
    }

    /**
     * Delete a book.
     * @param Book $book
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Book $book): JsonResponse
    {
        $this->authorize('delete', $book);

        $this->bookService->deleteBook($book->id);
        return response()->json(['message' => 'Book deleted successfully']);
    }

    /**
     * Attach tags to a book.
     * @param Request $request
     * @param Book $book
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function attachTags(Request $request, Book $book): JsonResponse
    {
        $this->authorize('attachTags', $book);

        $validated = $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $this->bookService->attachTagsToBook($book, $validated['tags']);
        return response()->json(['message' => 'Tags attached successfully']);
    }

    /**
     * Detach a tag from a book.
     * @param Book $book
     * @param $tagId
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function detachTag(Book $book, $tagId): JsonResponse
    {
        $this->authorize('detachTags', $book);

        $this->bookService->detachTagFromBook($book, $tagId);
        return response()->json(['message' => 'Tag detached successfully']);
    }

    /**
     * Show details of a book.
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return response()->json(new BookResource($this->bookService->getBookById($book->id)));
    }

    /**
     * Show a book with its tags.
     * @param Book $book
     * @return JsonResponse
     */
    public function showWithTags(Book $book): JsonResponse
    {
        return response()->json(new BookResource($this->bookService->getBookWithTags($book)));
    }
}

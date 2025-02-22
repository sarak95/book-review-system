<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;

/**
 * Class AuthorController
 */
class AuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    protected AuthorService $authorService;

    /**
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authors = $this->authorService->getAllAuthors();
        return response()->json($authors);
    }

    /**
     * @param AuthorRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        $this->authorize('create', Author::class);

        $author = $this->authorService->createAuthor($request->validated());
        return response()->json($author, 201);
    }

    /**
     * @param $authorId
     * @return JsonResponse
     */
    public function show($authorId): JsonResponse
    {
        $author = $this->authorService->getAuthorById($authorId);
        return response()->json($author);
    }

    /**
     * @param AuthorRequest $request
     * @param Author $author
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        $this->authorize('update', $author);

        $updatedAuthor = $this->authorService->updateAuthor($author->id, $request->validated());

        return response()->json($updatedAuthor);
    }

    /**
     * @param $authorId
     * @return JsonResponse
     */
    public function destroy($authorId): JsonResponse
    {
        $this->authorService->deleteAuthor($authorId);
        return response()->json(['message' => 'Author deleted successfully']);
    }
}


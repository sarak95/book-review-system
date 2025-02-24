<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Services\AuthorService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
     * @return ResourceCollection
     */
    public function index(): ResourceCollection
    {
        $authors = $this->authorService->getAllAuthors();
        return AuthorResource::collection($authors);
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
        return response()->json(new AuthorResource($author), 201);
    }

    /**
     * @param Author $author
     * @return JsonResponse
     */
    public function show(Author $author): JsonResponse
    {
        return response()->json(new AuthorResource($this->authorService->getAuthorById($author->id)));
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
        return response()->json(new AuthorResource($updatedAuthor));
    }

    /**
     * @param $authorId
     * @return JsonResponse
     */
    public function destroy(Author $author): JsonResponse
    {
        $this->authorize('delete', $author);

        $this->authorService->deleteAuthor($author->id);
        return response()->json(['message' => 'Author deleted successfully']);
    }
}

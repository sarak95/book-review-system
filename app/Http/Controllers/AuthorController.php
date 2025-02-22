<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        $authors = $this->authorService->getAllAuthors();
        return response()->json($authors);
    }

    public function store(AuthorRequest $request)
    {
        $this->authorize('create', Author::class);

        $author = $this->authorService->createAuthor($request->validated());
        return response()->json($author, 201);
    }

    public function show($authorId)
    {
        $author = $this->authorService->getAuthorById($authorId);
        return response()->json($author);
    }

    public function update(AuthorRequest $request, Author $author)
    {
        $this->authorize('update', $author);
        
        $updatedAuthor = $this->authorService->updateAuthor($author->id, $request->validated());
    
        return response()->json($updatedAuthor);
    }

    public function destroy($authorId)
    {
        $this->authorService->deleteAuthor($authorId);
        return response()->json(['message' => 'Author deleted successfully']);
    }
}


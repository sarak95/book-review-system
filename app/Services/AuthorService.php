<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAuthorById($id): ?Author
    {
        return $this->authorRepository->findById($id); 
    }

    public function getAllAuthors()
    {
        return $this->authorRepository->all();
    }

    public function createAuthor(array $data)
    {
        return $this->authorRepository->create($data);
    }

    public function updateAuthor(Author $author, array $data)
    {
        return $this->authorRepository->update($author, $data);
    }

    public function deleteAuthor(Author $author)
    {
        return $this->authorRepository->delete($author);
    }
}

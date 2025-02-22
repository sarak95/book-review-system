<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AuthorService
 */
class AuthorService
{
    /**
     * @var AuthorRepositoryInterface
     */
    protected AuthorRepositoryInterface $authorRepository;

    /**
     * @param AuthorRepositoryInterface $authorRepository
     */
    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    /**
     * @param $id
     * @return Author|null
     */
    public function getAuthorById($id): ?Author
    {
        return $this->authorRepository->findById($id);
    }

    /**
     * @return Collection
     */
    public function getAllAuthors() : Collection
    {
        return $this->authorRepository->all();
    }

    /**
     * @param array $data
     * @return Author
     */
    public function createAuthor(array $data) : Author
    {
        return $this->authorRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Author
     */
    public function updateAuthor($id, array $data) : Author
    {
        return $this->authorRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteAuthor($id) : void
    {
         $this->authorRepository->delete($id);
    }
}

<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BookService
 */
class BookService
{
    /**
     * @var BookRepository
     */
    protected BookRepository $bookRepository;

    /**
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @return Collection
     */
    public function getAllBooks() : Collection
    {
        return $this->bookRepository->getAll();
    }

    /**
     * @param $id
     * @return Book
     */
    public function getBookById($id) : Book
    {
        return $this->bookRepository->findById($id);
    }

    /**
     * @param array $data
     * @return Book
     */
    public function createBook(array $data) : Book
    {
        return $this->bookRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Book
     */
    public function updateBook($id, array $data) : Book
    {
        return $this->bookRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteBook($id) : bool
    {
        return $this->bookRepository->delete($id);
    }

    /**
     * @param Book $book
     * @param array $tagIds
     * @return Book
     */
    public function attachTagsToBook(Book $book, array $tagIds) : Book
    {
        return $this->bookRepository->attachTags($book, $tagIds);
    }

    /**
     * @param Book $book
     * @param int $tagId
     * @return void
     */
    public function detachTagFromBook(Book $book, int $tagId): void
    {
        $this->bookRepository->detachTagFromBook($book, $tagId);
    }

    /**
     * @param Book $book
     * @return Book
     */
    public function getBookWithTags(Book $book) : Book
    {
        return $this->bookRepository->getBooksWithTags($book);
    }


}

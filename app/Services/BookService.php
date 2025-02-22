<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;

class BookService
{
    protected BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getAllBooks() : Collection
    {
        return $this->bookRepository->getAll();
    }

    public function createBook(array $data) : Book
    {
        return $this->bookRepository->create($data);
    }

    public function updateBook($id, array $data) : Book
    {
        return $this->bookRepository->update($id, $data);
    }

    public function deleteBook($id) : bool
    {
        return $this->bookRepository->delete($id);
    }

    public function attachTagsToBook(Book $book, array $tagIds) : Book
    {
        return $this->bookRepository->attachTags($book, $tagIds); 
    }

    public function detachTagFromBook(Book $book, int $tagId): void
    {
        $this->bookRepository->detachTagFromBook($book, $tagId);
    }

    public function getBookWithTags(Book $book)
    {
        return $this->bookRepository->getBooksWithTags($book);
    }


}

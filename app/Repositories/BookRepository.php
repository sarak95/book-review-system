<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository extends BaseRepository
{
    public function __construct(Book $book)
    {
        parent::__construct($book);
    }

    public function attachTags(Book $book, array $tagIds) : Book
    {
        $book->tags()->sync($tagIds);
        return $book->load('tags');
    }

    public function detachTagFromBook(Book $book, int $tagId): void
    {
        $book->tags()->detach($tagId);
    }

    public function getBooksWithTags(Book $book)
    {
        return $book->load('tags');
    }
}

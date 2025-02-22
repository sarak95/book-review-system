<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function findById($id)
    {
        return Author::find($id);
    }

    public function all()
    {
        return Author::all();
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function update($author, array $data)
    {
        $author->update($data);
        return $author;
    }

    public function delete($author)
    {
        $author->delete();
    }
}



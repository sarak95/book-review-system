<?php

namespace App\Repositories;

use App\Models\Author;
use App\Repositories\Interfaces\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function findById($id) : Author
    {
        return Author::find($id);
    }

    public function all() : Collection
    {
        return Author::all();
    }

    public function create(array $data) : Author
    {
        return Author::create($data);
    }

    public function update($id, array $data) : Author
    {
        $author = Author::find($id);
        $author->update($data);
        return $author;
    }

    public function delete($id) : void
    {
        $author = Author::find($id);
        $author->delete();
    }

}



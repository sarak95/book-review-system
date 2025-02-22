<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{

    public function findById($id)
    {
        return Tag::findOrFail($id);
    }

    public function all()
    {
        return Tag::all();
    }

    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function update($tag, array $data)
    {
        $tag->update($data);
        return $tag;
    }

    public function delete($tag)
    {
        $tag->delete();
    }
}

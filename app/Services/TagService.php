<?php
namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Models\Tag;

class TagService
{
    protected $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getTagById($id)
    {
        return $this->tagRepository->findById($id);
    }

    public function getAllTags()
    {
        return $this->tagRepository->all();
    }

    public function createTag(array $data)
    {
        return $this->tagRepository->create($data);
    }

    public function updateTag(Tag $tag, array $data)
    {
        return $this->tagRepository->update($tag, $data);
    }

    public function deleteTag(Tag $tag)
    {
        return $this->tagRepository->delete($tag);
    }
}

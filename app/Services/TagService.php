<?php
namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

/**
 *
 */
class TagService
{
    /**
     * @var TagRepositoryInterface
     */
    protected TagRepositoryInterface $tagRepository;

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param $id
     * @return Tag
     */
    public function getTagById($id) : Tag
    {
        return $this->tagRepository->findById($id);
    }

    /**
     * @return Collection
     */
    public function getAllTags() : Collection
    {
        return $this->tagRepository->all();
    }

    /**
     * @param array $data
     * @return Tag
     */
    public function createTag(array $data) : Tag
    {
        return $this->tagRepository->create($data);
    }

    /**
     * @param Tag $tag
     * @param array $data
     * @return Tag
     */
    public function updateTag(Tag $tag, array $data) : Tag
    {
        return $this->tagRepository->update($tag, $data);
    }

    /**
     * @param Tag $tag
     * @return void
     */
    public function deleteTag(Tag $tag) : void
    {
         $this->tagRepository->delete($tag);
    }
}

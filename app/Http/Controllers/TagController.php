<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Services\TagService;
use App\Models\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class TagController
 */
class TagController extends Controller
{
    /**
     * @var TagService
     */
    protected TagService $tagService;

    /**
     * @param TagService $tagService
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags);
    }

    /**
     * @param $tagId
     * @return JsonResponse
     */
    public function show($tagId): JsonResponse
    {
        $tag = $this->tagService->getTagById($tagId);
        return response()->json($tag);
    }

    /**
     * @param TagRequest $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(TagRequest $request): JsonResponse
    {
        $this->authorize('create', Tag::class);

        $tag = $this->tagService->createTag($request->validated());
        return response()->json($tag, 201);
    }

    /**
     * @param TagRequest $request
     * @param Tag $tag
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(TagRequest $request, Tag $tag): JsonResponse
    {
        $this->authorize('update', $tag);

        $updatedTag = $this->tagService->updateTag($tag, $request->validated());
        return response()->json($updatedTag);
    }


    /**
     * @param Tag $tag
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Tag $tag): JsonResponse
    {
        $this->authorize('delete', $tag);

        $this->tagService->deleteTag($tag);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}

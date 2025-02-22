<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Services\TagService;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }


    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags);
    }

    public function show($tagId)
    {
        $tag = $this->tagService->getTagById($tagId);
        return response()->json($tag);
    }

    public function store(TagRequest $request)
    {
        $this->authorize('create', Tag::class); 

        $tag = $this->tagService->createTag($request->validated());
        return response()->json($tag, 201);
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag); 

        $updatedTag = $this->tagService->updateTag($tag, $request->validated());
        return response()->json($updatedTag);
    }


    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        $this->tagService->deleteTag($tag);
        return response()->json(['message' => 'Tag deleted successfully']);
    }
}

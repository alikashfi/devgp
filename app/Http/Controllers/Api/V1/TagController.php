<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        return TagResource::collection(Tag::filter()->get());
    }

    public function store(StoreTagRequest $request)
    {
        //
    }

    public function show(Tag $tag)
    {
        return new TagResource($tag);
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    public function destroy(Tag $tag)
    {
        //
    }
}

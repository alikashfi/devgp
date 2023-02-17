<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Group;

class CommentController extends Controller
{
    public function index()
    {
        $this->validate(request(), ['group' => 'required|string']);

        $group = Group::whereSlug(request('group'))->firstOrFail();
        $comments = Comment::filter()->whereGroupId($group->id)->paginate(10);

        return CommentResource::collection($comments);
    }

   public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->validated());

        return (new CommentResource($comment))
            ->response()
            ->setStatusCode(201);
    }
}

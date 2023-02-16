<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Group;

class CommentController extends Controller
{
    public function index()
    {
        $group = Group::whereSlug(request('group'))->firstOrFail();
        $comments = Comment::filter()->whereGroupId($group->id)->paginate(10);

        return response()->json($comments, 200);
    }

   public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }

    public function show(Comment $comment)
    {
        //
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    public function destroy(Comment $comment)
    {
        //
    }
}

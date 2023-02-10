<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::filter()->with('categories')->simplePaginate(10);

        return response()->json($groups);
    }

    public function related(Group $group)
    {
        $groups = Group::whereHas('categories', function ($q) use ($group) {
            $q->whereIn('categories.id', $group->categories()->pluck('categories.id')->toArray());
        })->whereNot('id', $group->id)->tops()->limit(min([request('limit'), 10]))->get();

        return response()->json($groups);
    }

    public function store(StoreGroupRequest $request)
    {
        //
    }

    public function show(Group $group)
    {
        return response()->json($group->load('categories'));
    }

    public function update(UpdateGroupRequest $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\DailyView;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::filter()->with('tags')->simplePaginate(10);
        return response()->json($groups);
    }

    public function related(Group $group)
    {
        $groups = Group::related($group)->with('tags')->get();
        return response()->json($groups);
    }

    public function store(StoreGroupRequest $request)
    {
        //
    }

    public function show(Group $group)
    {
        if ( ! DailyView::alreadyVisited($group))
            $group->increaseView();

        return response()->json($group->load('tags'));
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

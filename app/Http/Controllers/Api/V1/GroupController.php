<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Models\DailyView;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;

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
        $image = $this->storeImage($request);

        $group = Group::create(array_merge($request->validatedExcept('tags'), ['image' => $image]));
        $group->tags()->sync($request->tags);

        return response()->json($group);
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

    private function storeImage($request)
    {
        if ( ! $request->file('image'))
            return null;

        // naming
        $name = $this->generateName($request->slug);

        // resize and convert to jpg
        $image = Image::make($request->image)->resize(200, 200)->encode('jpg', 100);

        // store
        Storage::put("group/{$name}.jpg", $image);

        return "{$name}.jpg";
    }

    private function generateName($slug)
    {
        $name = file_sanitize($slug);
        $numberedName = $name;
        $i = 2;
        while (Storage::exists("group/{$numberedName}.jpg")) {
            $numberedName = $name . $i++;
        }
        return $numberedName;
    }
}

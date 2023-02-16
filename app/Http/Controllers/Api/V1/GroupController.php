<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\DailyView;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Image;

class GroupController extends Controller
{
    public function index()
    {
        return GroupResource::collection(Group::filter()->with('tags')->simplePaginate(10));
    }

    public function related(Group $group)
    {
        return GroupResource::collection(Group::related($group)->with('tags')->get());
    }

    public function store(StoreGroupRequest $request)
    {
        $image = $this->storeImage($request);

        $group = Group::create(array_merge($request->validatedExcept('tags'), ['image' => $image]));
        $request->tags && $group->tags()->sync($request->tags);

        return (new GroupResource($group->load('tags')))
            ->response()
            ->setStatusCode(201);
    }

    public function show(Group $group)
    {
        if ( ! DailyView::alreadyVisited($group))
            $group->increaseView();

        return new GroupResource($group->load('tags'));
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

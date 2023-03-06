<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\DailyIp;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Image;

class GroupController extends Controller
{
    public function __construct()
    {
        app()->setLocale('fa');
    }

    public function index()
    {
        return GroupResource::collection(Group::filter()->with('tags')->paginate(10));
    }

    public function related(Group $group)
    {
        return GroupResource::collection(Group::related($group)->with('tags')->get());
    }

    public static function store(StoreGroupRequest $request)
    {
        $image = Group::storeImage($request);

        $group = Group::create(array_merge($request->validatedExcept('tags'), ['image' => $image]));
        $request->tags && $group->tags()->sync($request->tags);

        return (new GroupResource($group->load('tags')))
            ->response()
            ->setStatusCode(201);
    }

    public static function show(Group $group)
    {
        if ( ! DailyIp::alreadyVisited($group))
            $group->increaseView();

        return new GroupResource($group->load('tags'));
    }
}

<?php

namespace App\Swagger;

use Illuminate\Http\JsonResponse;

/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="Returns Services API",
 *      version="v1",
 *      description="API endpoints of devgp project.",
 *  )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Api v1"
 * )
 */
class Endpoints
{
    /**
     * @OA\Get(
     *     path="/groups",
     *     tags={"Groups"},
     *     summary="get list of the groups",
     *
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="page number",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="tag",
     *         in="query",
     *         description="slug of a tag",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="order by which column(members-views-daily_views) e.g. <b>views,desc</b>",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search term",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="array of groups returned",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/GroupModel"),
     *             )
     *         )
     *     ),
     * )
     */
    public function groups()
    {
    }

    /**
     * @OA\Get(
     *     path="/groups/{slug}",
     *     tags={"Groups"},
     *     summary="get a group by slug",
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="The slug of group",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="group details returned",
     *         @OA\JsonContent(ref="#/components/schemas/GroupModel")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="group not found",
     *     ),
     * )
     */
    public function singleGroup()
    {
    }

    /**
     * @OA\Post(
     *     path="/groups",
     *     tags={"Groups"},
     *     summary="create new group",
     *
     *     @OA\Parameter(
     *         name="image",
     *         in="path",
     *         description="image file of the group",
     *         required=false,
     *         @OA\Schema(
     *             type="file",
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreGroupRequest")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="group details returned",
     *         @OA\JsonContent(ref="#/components/schemas/GroupModel")
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="form validation error",
     *     ),
     * )
     */
    public function storeGroup()
    {
    }

    /**
     * @OA\Get(
     *     path="/groups/{slug}/related",
     *     tags={"Groups"},
     *     summary="get list of the related groups",
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="The slug of group",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="The count of related groups",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *             maximum=10,
     *             minimum=1,
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="array of related groups returned",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/GroupModel"),
     *             )
     *         )
     *     ),
     * )
     */
    public function relatedGroups()
    {
    }

    /**
     * @OA\Get(
     *     path="/tags/{slug}",
     *     tags={"Tags"},
     *     summary="get a tag by slug",
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="The slug of tag",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="group details returned",
     *         @OA\JsonContent(ref="#/components/schemas/TagModel")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="tag not found",
     *     ),
     * )
     */
    public function singleTag()
    {
    }

    /**
     * @OA\Get(
     *     path="/tags",
     *     tags={"Tags"},
     *     summary="search between tags (use in create-group form)",
     *
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search term",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="maximum number of results",
     *         required=false,
     *         @OA\Schema(
     *             type="integer",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="array of tags returned",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/TagModel"),
     *             )
     *         )
     *     ),
     * )
     */
    public function searchTags()
    {
    }
}
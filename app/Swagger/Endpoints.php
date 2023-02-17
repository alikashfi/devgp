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
     *         description="order by which column(members-views-daily_views) e.g. views,desc",
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
     *                 @OA\Items(ref="#/components/schemas/GroupSchema"),
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
     *         @OA\JsonContent(ref="#/components/schemas/GroupSchema")
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
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(ref="#/components/schemas/StoreGroupRequestSchema"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="group created successfully and returned as response.",
     *         @OA\JsonContent(ref="#/components/schemas/GroupSchema")
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
     *                 @OA\Items(ref="#/components/schemas/GroupSchema"),
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
     *         @OA\JsonContent(ref="#/components/schemas/TagSchema")
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
     *                 @OA\Items(ref="#/components/schemas/TagSchema"),
     *             )
     *         )
     *     ),
     * )
     */
    public function searchTags()
    {
    }

    /**
     * @OA\Get(
     *     path="/comments",
     *     tags={"Comments"},
     *     summary="get comments of a specific group",
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
     *         name="group",
     *         in="query",
     *         description="the slug of the associated group",
     *         required=true,
     *         example="laravel",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="order by created_at,desc or created_at,asc",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="array of comments returned",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CommentSchema"),
     *             )
     *         )
     *     ),
     * )
     */
    public function comments()
    {
    }

    /**
     * @OA\Post(
     *     path="/comments",
     *     tags={"Comments"},
     *     summary="create new comment",
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *            mediaType="application/json",
     *            @OA\Schema(ref="#/components/schemas/StoreCommentRequestSchema"),
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="comment created successfully and returned as response.",
     *         @OA\JsonContent(ref="#/components/schemas/CommentSchema")
     *     ),
     *     @OA\Response(
     *         response="403",
     *         description="form validation error",
     *     ),
     * )
     */
    public function storeComment()
    {
    }
}
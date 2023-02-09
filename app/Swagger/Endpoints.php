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
     *         name="category",
     *         in="query",
     *         description="slug of a category",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="e.g. js-groups",
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="sort",
     *         in="query",
     *         description="orderBy which column",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             example="e.g. members",
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
     *         description="image file",
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
     *     path="/categories/{slug}",
     *     tags={"Categories"},
     *     summary="get a category by slug",
     *
     *     @OA\Parameter(
     *         name="slug",
     *         in="path",
     *         description="The slug of category",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="group details returned",
     *         @OA\JsonContent(ref="#/components/schemas/CategoryModel")
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="category not found",
     *     ),
     * )
     */
    public function singleCategory()
    {
    }

    /**
     * @OA\Get(
     *     path="/categories",
     *     tags={"Categories"},
     *     summary="search between categories (use in create-group form)",
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
     *         description="array of categories returned",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CategoryModel"),
     *             )
     *         )
     *     ),
     * )
     */
    public function searchCategories()
    {
    }
}
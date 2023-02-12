<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Group",
 * )
 */
class GroupModel
{
    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   example="گروه برنامه نویسان لاراول در تلگرام",
     *   description=".",
     * )
     */
    public $name;

    /**
     * @OA\Property(
     *   property="slug",
     *   type="string",
     *   example="laravel",
     *   description="english name of the group for url",
     * )
     */
    public $slug;

    /**
     * @OA\Property(
     *   property="image",
     *   type="string",
     *   example="https://site.com/full/path/to/laravel.jpg",
     *   description=".",
     * )
     */
    public $image;

    /**
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   example="",
     *   description=".",
     * )
     */
    public $description;

    /**
     * @OA\Property(
     *   property="link",
     *   type="string",
     *   format="uri",
     *   example="https://t.me/laravel",
     *   description=".",
     * )
     */
    public $link;

    /**
     * @OA\Property(
     *   property="members",
     *   type="number",
     *   format="int64",
     *   example="2000",
     *   description="number of group members",
     * )
     */
    public $members;

    /**
     * @OA\Property(
     *   property="views",
     *   type="number",
     *   format="int64",
     *   example="100",
     *   description="page views in our site",
     * )
     */
    public $views;
}
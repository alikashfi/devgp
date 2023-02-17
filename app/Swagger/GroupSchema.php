<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Group",
 * )
 */
class GroupSchema
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
     *   description="group description text. (show as html. it's secure.)",
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
     *   property="support_link",
     *   type="string",
     *   format="uri",
     *   example="https://t.me/admin-laravel",
     *   description=".",
     * )
     */
    public $support_link;

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

    /**
     * @OA\Property(
     *   property="diff",
     *   type="string",
     *   description="difference between created_at and now in persian",
     *   example="3 دقیقه قبل",
     * )
     */
    public $diff;

    /**
     * @OA\Property(
     *   property="created_at",
     *   type="string",
     *   description=".",
     *   example="2023-02-17 17:14:11",
     * )
     */
    public $created_at;

    /**
     * @OA\Property(
     *   property="updated_at",
     *   type="string",
     *   description=".",
     *   example="2023-03-20 18:15:13",
     * )
     */
    public $updated_at;
}
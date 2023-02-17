<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     type="object",
 *     required={"name", "link"},
 * )
 */
class StoreGroupRequestSchema
{
    /**
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     example="گروه برنامه نویسان لاراول در تلگرام",
     *     description=".",
     * )
     */
    public $name;

    /**
     * @OA\Property(
     *     property="slug",
     *     type="string",
     *     example="laravel",
     *     description="english name of the group for url",
     * )
     */
    public $slug;

    /**
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   example="لورم ایپسوم متن ساختگی...",
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
     *   property="tags",
     *   description="array of tag slugs e.g. ['slug1', 'slug2'] (don't try adding tag in swagger's &#8221;Try it out&#8221; mode, cuz I couldn't make it work in swagger😐 but it works in api...)",
     *   type="array",
     *   @OA\Items(type="string"),
     * )
     */
    public $tags;

    /**
     * @OA\Property(
     *   property="image",
     *   description="image of the group",
     *   type="string",
     *   format="binary"
     * )
     */
    public $image;
}
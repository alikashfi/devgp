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
     *   property="tags[]",
     *   property="tags",
     *   description="array of tag slugs (max=5) e.g. `tags[]=tag1 tags[]=tag2`.<br>*but due to [l5-swagger bug](https://github.com/DarkaOnLine/L5-Swagger/issues/354), if you gonna &#8221;Try it out&#8221; here, leave it empty.*",
     *   type="array",
     *   collectionFormat="multi",
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
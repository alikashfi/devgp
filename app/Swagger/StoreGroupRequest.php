<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     type="object",
 *     required={"name", "address"},
 * )
 */
class StoreGroupRequest
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
     *   property="address",
     *   type="string",
     *   format="uri",
     *   example="https://t.me/laravel",
     *   description=".",
     * )
     */
    public $address;

    /**
     * @OA\Property(
     *   property="tags",
     *   type="array",
     *   @OA\Items(
     *        type="string",
     *   ),
     *   example="['laravel', 'backend']",
     *   description="array of tag slugs",
     * )
     */
    public $tags;

    /**
     * @OA\Property(
     *   property="image",
     *   type="string",
     *   format="byte",
     *   description="image of group",
     * )
     */
    public $image;
}
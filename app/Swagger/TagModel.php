<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Tag",
 * )
 */
class TagModel
{
    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   example="جاوا اسکریپت",
     *   description=".",
     * )
     */
    public $name;

    /**
     * @OA\Property(
     *   property="title",
     *   type="string",
     *   description="\<title\> tag for seo",
     *   example="گروه های برنامه نویسی جاوا اسکریپت",
     * )
     */
    public $title;

    /**
     * @OA\Property(
     *   property="slug",
     *   type="string",
     *   example="js-gropus",
     *   description=".",
     * )
     */
    public $slug;

    /**
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   description="most of times is null. but maybe sometimes needed for seo...",
     *   example="",
     * )
     */
    public $description;

    /**
     * @OA\Property(
     *   property="color",
     *   type="string",
     *   example="#ff0000",
     *   description=".",
     * )
     */
    public $color;
}
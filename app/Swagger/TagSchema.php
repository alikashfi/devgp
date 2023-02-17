<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Tag",
 * )
 */
class TagSchema
{
    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   example="جاوا اسکریپت or javascript",
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
     *   example="javascript",
     *   description="english name of the tag for url",
     * )
     */
    public $slug;

    /**
     * @OA\Property(
     *   property="description",
     *   type="string",
     *   description="for top of tag page, to improve seo. most of times is null btw :))",
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
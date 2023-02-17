<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="Comment",
 * )
 */
class CommentSchema
{
    /**
     * @OA\Property(
     *   property="name",
     *   type="string",
     *   example="ممد ممدیان",
     *   description=".",
     * )
     */
    public $name;

    /**
     * @OA\Property(
     *   property="message",
     *   type="string",
     *   description="message text. (show as html. it's secure.)",
     *   example="لورم ایپسوم متن ساختگلی",
     * )
     */
    public $message;

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
}
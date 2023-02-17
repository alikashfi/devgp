<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="StoreCommentRequestSchema",
 *     required={"group", "name", "message"},
 * )
 */
class StoreCommentRequestSchema
{
    /**
     * @OA\Property(
     *   property="group",
     *   type="string",
     *   example="laravel",
     *   description="the slug of the associated group",
     * )
     */
    public $group;

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
     *   property="email",
     *   type="string",
     *   format="email",
     *   description=".",
     *   example="mammad.mammadian@gmail.com",
     * )
     */
    public $email;

    /**
     * @OA\Property(
     *   property="message",
     *   type="string",
     *   description=".",
     *   example="لورم ایپسوم متن ساختگلی",
     * )
     */
    public $message;
}
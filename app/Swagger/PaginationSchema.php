<?php

namespace App\Swagger;

/**
 * @OA\Schema(
 *     title="PaginationSchema"
 * )
 */
class PaginationSchema
{
    /**
     * @OA\Property(
     *     property="links",
     *     type="object",
     *     @OA\Property(
     *         property="first",
     *         type="string",
     *         example="https://site.com/api/v1/groups?page=1",
     *     ),
     *     @OA\Property(
     *         property="last",
     *         type="string",
     *         example="https://site.com/api/v1/groups?page=8",
     *     ),
     *     @OA\Property(
     *         property="prev",
     *         type="string",
     *         example=null,
     *     ),
     *     @OA\Property(
     *         property="next",
     *         type="string",
     *         example="https://site.com/api/v1/groups?page=2",
     *     )
     * ),
     * @OA\Property(
     *     property="meta",
     *     type="object",
     *     @OA\Property(
     *         property="current_page",
     *         type="number",
     *         example="1",
     *     ),
     *     @OA\Property(
     *         property="from",
     *         type="number",
     *         example="1",
     *     ),
     *     @OA\Property(
     *         property="path",
     *         type="string",
     *         example="https://site.com/api/v1/groups",
     *     ),
     *     @OA\Property(
     *         property="per_page",
     *         type="number",
     *         example="10",
     *     ),
     *     @OA\Property(
     *         property="to",
     *         type="number",
     *         example="10",
     *     )
     * )
     */
    public $variable;
}
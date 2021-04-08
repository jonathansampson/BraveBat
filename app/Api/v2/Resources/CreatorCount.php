<?php

namespace App\Api\v2\Resources;

/**
 * Class CreatorCount
 *
 * @OA\Schema(
 *     title="CreatorCount"
 * )
 */
class CreatorCount
{
    /**
     * @OA\Property(
     *     title="Category",
     *     description="Channel category of a creator",
     *     type="string",
     * )
     */
    private $category;

    /**
     * @OA\Property(
     *     title="Data",
     *     description="Count Data",
     *     type="number"
     * )
     */
    private $data;

}

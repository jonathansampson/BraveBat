<?php

namespace App\Api\v2\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorRedditResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "verified" => true,
        ];
    }
}

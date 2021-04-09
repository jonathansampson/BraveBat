<?php

namespace App\Api\v2\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorYoutubeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'link' => $this->link,
            'name' => $this->name,
            'description' => $this->description,
            'subscribers' => $this->follower_count,
            "verified" => true,
        ];
    }
}

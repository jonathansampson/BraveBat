<?php

namespace App\Api\v2\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorTwitchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'link' => $this->link,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
            'followers' => $this->follower_count,
            'views' => $this->view_count,
            "verified" => true,
        ];
    }
}

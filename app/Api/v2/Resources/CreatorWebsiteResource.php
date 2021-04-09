<?php

namespace App\Api\v2\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorWebsiteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'link' => $this->link,
            'alexa_ranking' => $this->alexa_ranking,
            "verified" => true,
        ];
    }
}

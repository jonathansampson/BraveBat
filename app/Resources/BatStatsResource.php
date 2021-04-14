<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BatStatsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'record_date' => $this->record_date->toDateString(),
            'holders_count' => $this->holders_count,
            'holders_add' => $this->holders_add,
            'price' => round($this->price, 3),
            'volume_in_millions' => round($this->volume / 1_000_000, 1),
            'market_cap_in_billions' => round($this->market_cap / 1_000_000_000, 2),
        ];

    }
}

<?php

namespace App\Models\Creators;

use App\Services\YoutubeService;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $guarded = [];

    protected $table = 'creator_youtube';

    /**
     * Get the creator
     */
    public function creator()
    {
        return $this->morphOne('App\Models\Creator', 'creatable');
    }

    public function callApi()
    {
        $service = new YoutubeService();
    }
}

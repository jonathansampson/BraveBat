<?php

namespace App\Models\Creators;

use App\Services\YoutubeService;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use CreatableTrait;

    protected $guarded = [];
    protected $table = 'creator_youtube';

    public function callApi()
    {
        $service = new YoutubeService();
        if ($this->youtube_id) {
            $response = $service->getChannel($this->youtube_id);
            if ($response['success']) {
                $this->update($response['result']);
                $this->syncName();
            }
        }
    }

    public function link()
    {
        return "https://www.youtube.com/channel/{$this->youtube_id}";
    }
}

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

    public static function rank()
    {
        $creatables = self::whereNotNull('thumbnail')->orderBy('subscriber_count', 'desc')->get();
        $fraction = 1 / $creatables->count();
        foreach ($creatables as $index => $creatable) {
            $creator = $creatable->creator;
            $creator->rank = $index * $fraction;
            $creator->save();
        }
    }
}

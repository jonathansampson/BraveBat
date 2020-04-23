<?php

namespace App\Models\Creators;

use App\Services\TwitterService;
use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    use CreatableTrait;

    protected $guarded = [];
    protected $table = 'creator_twitter';

    public function callApi()
    {
        $service = cache()->remember('twitter_service', 1800, function () {
            return new TwitterService();
        });
        if ($this->twitter_id) {
            $response = $service->getUser($this->twitter_id);
            if ($response['success']) {
                $this->update($response['result']);
                $this->syncName();
            }
        }
    }

    public function link()
    {
        return "https://twitter.com/{$this->name}";
    }

    public static function rank()
    {
        $creatables = self::whereNotNull('thumbnail')->orderBy('follower_count', 'desc')->get();
        $fraction = 1 / $creatables->count();
        foreach ($creatables as $index => $creatable) {
            $creator = $creatable->creator;
            $creator->rank = $index * $fraction;
            $creator->save();
        }
    }
}

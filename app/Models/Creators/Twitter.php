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
        $service = new TwitterService();
        if ($this->twitter_id) {
            $response = $service->getUser($this->twitter_id);
            if ($response['success']) {
                $this->update($response['result']);
                $this->syncName();
            }
        }
    }
}

<?php

namespace App\Models\Creators;

use App\Services\TwitchService;
use Illuminate\Database\Eloquent\Model;

class Twitch extends Model
{
    use CreatableTrait;

    protected $guarded = [];
    protected $table = 'creator_twitch';

    public function callApi()
    {
        $service = new TwitchService();
        if ($this->name) {
            $response = $service->getUser($this->name);
            if ($response['success']) {
                $this->update($response['result']);
                $this->syncName();
            }
        }
    }
}

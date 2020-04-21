<?php

namespace App\Models;

use App\Models\Creators\Twitch;
use App\Models\Creators\Twitter;
use App\Models\Creators\Vimeo;
use Carbon\Carbon;
use App\Models\Creators\Website;
use App\Models\Creators\Youtube;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

    /**
     * Get the owning creatable model.
     */
    public function creatable()
    {
        return $this->morphTo();
    }

    /**
     * Handle input from Brave API
     *
     * @param $incomings, outgoings
     * @return void
     */
    public static function handleInput($incomings, $outgoings)
    {
        // Handle incomings
        foreach ($incomings as $incoming) {
            $existing = self::where('creator', $incoming)->first();
            if ($existing) {
                $existing->active = true;
                $existing->save();
            } else {
                $creator = self::create([
                    'creator' => $incoming,
                    'active' => true,
                    'channel' => '',
                    'verified_at' => Carbon::today()
                ]);
                $creator->fillChannel();
                // $creator->processCreatable();
            }
        }

        // Handle outgoings
        foreach ($outgoings as $outgoing) {
            $creator = self::where('creator', $outgoing)->first();
            $creator->active = false;
            $creator->save();
        }
    }

    public function fillChannel()
    {
        $parts = explode('#channel:', $this->creator);
        if (count($parts) == 2) {
            $this->channel = $parts[0];
            $this->channel_id = $parts[1];
        } else {
            $parts = explode('#author:', $this->creator);
            if (count($parts) == 2 && $parts[0] == 'twitch') {
                $this->channel = $parts[0];
                $this->channel_id = $parts[1];
            } else {
                $this->channel = 'website';
                $this->channel_id = $this->creator;
            }
        }
        $this->save();
    }

    public function processCreatable()
    {
        if ($this->channel == 'website') {
            $this->processWebsite();
        } elseif ($this->channel == 'youtube') {
            $this->processYoutube();
        } elseif ($this->channel == 'twitch') {
            $this->processTwitch();
        } elseif ($this->channel == 'twitter') {
            $this->processTwitter();
        } elseif ($this->channel == 'vimeo') {
            $this->processVimeo();
        }
    }

    public function processWebsite()
    {
        $website = $this->creatable ?? Website::create(['name' => $this->channel_id]);
        $this->creatable()->associate($website)->save();
        $website->callApi();
    }

    public function processYoutube()
    {
        $youtube = $this->creatable ?? Youtube::create(['youtube_id' => $this->channel_id]);
        $this->creatable()->associate($youtube)->save();
        $youtube->callApi();
    }

    public function processTwitch()
    {
        $twitch = $this->creatable ?? Twitch::create(['name' => $this->channel_id]);
        $this->creatable()->associate($twitch)->save();
        $twitch->callApi();
    }

    public function processTwitter()
    {
        $twitter = $this->creatable ?? Twitter::create(['twitter_id' => $this->channel_id]);
        $this->creatable()->associate($twitter)->save();
        $twitter->callApi();
    }

    public function processVimeo()
    {
        $vimeo = $this->creatable ?? Vimeo::create(['vimeo_id' => $this->channel_id]);
        $this->creatable()->associate($vimeo)->save();
        $vimeo->callApi();
    }
}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\CreatorProcessors\VimeoProcessor;
use App\Models\CreatorProcessors\GithubProcessor;
use App\Models\CreatorProcessors\TwitchProcessor;
use App\Models\CreatorProcessors\TwitterProcessor;
use App\Models\CreatorProcessors\WebsiteProcessor;
use App\Models\CreatorProcessors\YoutubeProcessor;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

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
            (new WebsiteProcessor($this))->process();
        } elseif ($this->channel == 'youtube') {
            (new YoutubeProcessor($this))->process();
        } elseif ($this->channel == 'twitch') {
            (new TwitchProcessor($this))->process();
        } elseif ($this->channel == 'twitter') {
            (new TwitterProcessor($this))->process();
        } elseif ($this->channel == 'vimeo') {
            (new VimeoProcessor($this))->process();
        } elseif ($this->channel == 'github') {
            (new GithubProcessor($this))->process();
        }
        $this->last_processed_at = now();
        $this->save();
    }
}

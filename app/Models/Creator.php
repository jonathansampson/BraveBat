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
use App\Services\SimpleScheduledTaskSlackAndLogService;
use DB;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

    /**
     * Handle incomings from Brave API
     *
     * @param $incomings
     * @return void
     */
    public static function handleIncomings($incomings)
    {
        foreach ($incomings as $incoming) {
            $creator = self::make([
                'creator' => $incoming,
                'verified_at' => Carbon::today()
            ]);
            $creator->fillChannel();
        }
    }

    /**
     * Handle outgoings from Brave API
     *
     * @param $outgoings
     * @return void
     */
    public static function handleOutgoings($outgoings)
    {
        if (count($outgoings) <= 20000) {
            foreach ($outgoings as $outgoing) {
                self::where('creator', $outgoing)->delete();
            }
        } else {
            SimpleScheduledTaskSlackAndLogService::message('something is wrong with outgoing creators. No deletion is made');
        }
    }

    public static function creator_count()
    {
        $results = DB::select("SELECT channel, count(id) as count from creators group by channel");
        $creator_count = [];
        foreach ($results as $result) {
            $creator_count[$result->channel] = $result->count;
        }
        $creator_count['overall'] = array_sum($creator_count);
        return $creator_count;
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

    public static function rank()
    {
        $channels = ['youtube', 'vimeo', 'twitter', 'github', 'twitch'];
        foreach ($channels as $channel) {
            $creators = self::query()
                ->where('valid', true)
                ->where('channel', $channel)
                ->orderBy('follower_count', 'desc')
                ->get();
            if ($creators->count()) {
                $fraction = 1 / $creators->count();
                foreach ($creators as $index => $creator) {
                    $creator->rank = $index * $fraction;
                    $creator->save();
                }
            }
        }

        $creators = self::query()
            ->where('valid', true)
            ->where('channel', 'website')
            ->orderBy('alexa_ranking', 'asc')
            ->get();
        if ($creators->count()) {
            $fraction = 1 / $creators->count();
            foreach ($creators as $index => $creator) {
                $creator->rank = $index * $fraction;
                $creator->save();
            }
        }
    }
}

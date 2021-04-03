<?php

namespace App\Models;

use App\Models\CreatorProcessors\GithubProcessor;
use App\Models\CreatorProcessors\TwitchProcessor;
use App\Models\CreatorProcessors\TwitterProcessor;
use App\Models\CreatorProcessors\VimeoProcessor;
use App\Models\CreatorProcessors\WebsiteProcessor;
use App\Models\CreatorProcessors\YoutubeProcessor;
use App\Models\Stats\CreatorDailyStats;
use App\Services\SimpleScheduledTaskSlackAndLogService;
use App\Services\TweetService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creator extends Model
{
    protected $table = 'creators';
    protected $guarded = [];

    use HasFactory;

    public static function handleIncomings($incomings)
    {
        foreach ($incomings as $incoming) {
            $existingCreator = self::where('creator', $incoming)->first();
            if ($existingCreator) {
                $existingCreator->update(['confirmed_at' => today()]);
            } else {
                $creator = self::create([
                    'creator' => $incoming,
                    'verified_at' => today(),
                    'confirmed_at' => today(),
                ]);
                $creator->fillChannel();
            }
        }
    }

    public static function creator_count()
    {
        return cache()->remember('creator_count', 3600, function () {
            $last_date = CreatorDailyStats::orderBy('record_date', 'desc')->first()->record_date;
            $results = CreatorDailyStats::where('record_date', $last_date)->get();
            $creator_count = [];
            foreach ($results as $result) {
                $creator_count[$result->channel] = $result->total;
            }
            $creator_count['overall'] = array_sum($creator_count);
            return $creator_count;
        });
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

    public function getRanking($ceiling)
    {
        if ($this->channel == 'website') {
            $this->ranking = $ceiling / $this->alexa_ranking;
        } else {
            $this->ranking = $this->follower_count / $ceiling;
        }
        $this->save();
    }

    public static function fillRankings()
    {
        $channels = ['youtube', 'vimeo', 'twitter', 'github', 'twitch'];
        foreach ($channels as $channel) {
            $top_creator = self::query()
                ->where('valid', true)
                ->whereNotNull('name')
                ->whereNotNull('follower_count')
                ->where('channel', $channel)
                ->orderBy('follower_count', 'desc')
                ->first();

            if ($top_creator) {
                $unranked_creators = self::query()
                    ->where('valid', true)
                    ->whereNotNull('follower_count')
                    ->whereNotNull('name')
                    ->whereNull('ranking')
                    ->where('channel', $channel)
                    ->orderBy('follower_count', 'desc')
                    ->get();

                foreach ($unranked_creators as $unranked_creator) {
                    $unranked_creator->getRanking($top_creator->follower_count);
                }
            }
        }

        $channels = ['website'];
        foreach ($channels as $channel) {
            $top_creator = self::query()
                ->where('valid', true)
                ->whereNotNull('name')
                ->whereNotNull('alexa_ranking')
                ->where('channel', $channel)
                ->orderBy('alexa_ranking', 'asc')
                ->first();
            if ($top_creator) {
                $unranked_creators = self::query()
                    ->where('valid', true)
                    ->whereNotNull('alexa_ranking')
                    ->whereNotNull('name')
                    ->whereNull('ranking')
                    ->where('channel', $channel)
                    ->orderBy('alexa_ranking', 'asc')
                    ->get();

                foreach ($unranked_creators as $unranked_creator) {
                    $unranked_creator->getRanking($top_creator->alexa_ranking);
                }
            }
        }
    }

    public function tweet_message()
    {
        $alexa_ranking = number_format($this->alexa_ranking);
        $follower_count = number_format($this->follower_count);
        if ($this->channel == 'website') {
            return "{$this->name} is just verified as a #bravebrowser Creator with an Alexa ranking of {$alexa_ranking}. 👏 {$this->link}";
        }
        if ($this->channel == 'youtube') {
            return "YouTube channel {$this->name} is just verified as a #bravebrowser Creator with {$follower_count} subscribers. 🙌 {$this->link}";
        }
        if ($this->channel == 'twitch') {
            return "Twitch channel {$this->name} is just verified as a #bravebrowser Creator with {$follower_count} followers. 🎉 {$this->link}";
        }
        if ($this->channel == 'twitter') {
            return "Twitter account {$this->name} is just verified as a #bravebrowser Creator with {$follower_count} followers. 👏 {$this->link}";
        }
        if ($this->channel == 'vimeo') {
            return "Vimeo channel {$this->name} is just verified as a #bravebrowser Creator with {$follower_count} followers. 🙌 {$this->link}";
        }
        if ($this->channel == 'github') {
            return "Github user {$this->name} is just verified as a #bravebrowser Creator with {$follower_count} followers. 🎉 {$this->link}";
        }
    }

    public static function tweet($channel, $threshold)
    {
        $top_creator = self::query()
            ->where('valid', true)
            ->whereNotNull('name')
            ->where('ranking', '>', $threshold)
            ->where('channel', $channel)
            ->where('verified_at', today()->toDateString())
            ->orderBy('ranking', 'desc')
            ->first();
        if ($top_creator) {
            SimpleScheduledTaskSlackAndLogService::message($top_creator->tweet_message());
            $tweet_service = new TweetService();
            $tweet_service->postTweet($top_creator->tweet_message());
        }
    }

    public function screenshot()
    {
        return config('bravebat.s3') . $this->screenshot;
    }

    public function toSearchArray()
    {
        return [
            'id' => $this->id,
            'channel' => $this->channel,
            'name' => $this->name,
            'ranking' => $this->ranking,
            'follower_count' => $this->follower_count,
            'alexa_ranking' => $this->alexa_ranking,
        ];
    }
}

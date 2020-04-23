<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class CreatorsController extends Controller
{

    public function index($channel)
    {
        $channels = [
            'website' => [
                'creator_title' => 'Website Creator',
                'rank_column_title' => 'Alexa Ranking',
                'rank_column' => 'alexa_ranking',
                'rank_order' => 'asc',
            ],
            'youtube' => [
                'creator_title' => 'YouTuber',
                'rank_column_title' => 'Subscribers',
                'rank_column' => 'follower_count',
                'rank_order' => 'desc',
            ],
            'vimeo' => [
                'creator_title' => 'Vimeo Creator',
                'rank_column_title' => 'Folowers',
                'rank_column' => 'follower_count',
                'rank_order' => 'desc',
            ],
            'twitter' => [
                'creator_title' => 'Twitter User',
                'rank_column_title' => 'Followers',
                'rank_column' => 'follower_count',
                'rank_order' => 'desc',
            ],
            'twitch' => [
                'creator_title' => 'Twitch Streamer',
                'rank_column_title' => 'Followers',
                'rank_column' => 'follower_count',
                'rank_order' => 'desc',
            ],
        ];
        if (!isset($channels[$channel])) {
            abort(404);
        }
        $channel_info = $channels[$channel];
        $creators = Creator::query()
            ->where("active", true)
            ->where("valid", true)
            ->whereNotNull("name")
            ->whereNotNull("link")
            ->where('channel', $channel)
            ->orderBy($channel_info['rank_column'], $channel_info['rank_order'])
            ->paginate(10);
        $column = $channel_info['rank_column'];
        return view('creators.index', compact('creators', 'channel', 'channel_info', 'column'));
    }

    public function show($channel, $id)
    {
        $creator = Creator::where('id', $id)
            ->where('channel', $channel)
            ->first();
        if ($creator) {
            return view('creators.show', compact('creator'));
        }
        abort(404);
    }
}

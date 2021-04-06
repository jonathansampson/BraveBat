<?php

namespace App\Http\Controllers;

use App\Models\Creator;

class CreatorsController extends Controller
{
    public function index($channel)
    {
        $allowedChannels = ['website', 'youtube', 'vimeo', 'twitter', 'twitch', 'github'];
        abort_if(!in_array($channel, $allowedChannels), 404);
        $count = Creator::searchable()->where('channel', $channel)->count();
        return view('creators.index', compact('channel', 'count'));
    }

    public function show($channel, $id)
    {
        $creator = Creator::where('id', $id)
            ->where('channel', $channel)
            ->firstOrFail();
        return view('creators.show', compact('creator'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorsController extends Controller
{

    public function index($channel)
    {
        $websites = Creator::query()
            ->where('channel', 'website')
            // ->whereNotNull("alexa_ranking")
            // ->orderBy('alexa_ranking', 'asc')
            ->paginate(10);
        return view('creators.index', compact('websites'));
    }

    public function show($channel, $id)
    {
        $creator = Creator::where('id', $id)
            ->where('channel', $channel)
            ->whereNotNull('name')->first();
        if ($creator) {
            $creatable = $creator->creatable;
            return view('creators.show', compact('creator', 'creatable'));
        }

        abort(404);
    }
}

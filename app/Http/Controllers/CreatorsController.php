<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorsController extends Controller
{

    public function index($channel)
    {
        $channel = 'website';
        $creators = Creator::where('channel', $channel)->get();
        dd($creators);
    }

    public function show($channel, $name)
    {
        $creator = Creator::where('channel', $channel)->where('name', $name)->first();
        dd($creator);
    }
}

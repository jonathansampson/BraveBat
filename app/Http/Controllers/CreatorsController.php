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
        return 'index';
        // dd($creators);
    }

    public function show($id)
    {
        $creator = Creator::find($id);
        return 'show';
        // dd($creator);
    }
}

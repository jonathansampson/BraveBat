<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorsController extends Controller
{

    public function index($channel)
    {
        return view('creators.index');
    }

    public function show($id)
    {
        $creator = Creator::find($id);
        return 'show';
        // dd($creator);
    }
}

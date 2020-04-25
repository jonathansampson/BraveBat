<?php

namespace App\Http\Controllers;

use App\Models\Creator;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('index');
    }

    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $creator_count = Creator::count();
        return view('welcome', compact('creator_count'));
    }

    public function privacy_policy()
    {
        return view('privacy_policy');
    }
}

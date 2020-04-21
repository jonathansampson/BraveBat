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
        return view('welcome');
    }
}

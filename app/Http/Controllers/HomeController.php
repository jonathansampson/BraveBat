<?php

namespace App\Http\Controllers;

use App\Services\BraveTransparencyService;
use Illuminate\Http\Request;


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

        $service = new BraveTransparencyService();
        dump($service->dom);
        return view('welcome');
    }
}

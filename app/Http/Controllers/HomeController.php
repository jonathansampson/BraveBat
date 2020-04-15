<?php

namespace App\Http\Controllers;

use App\Services\BraveTransparencyService;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;

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
        $html = Browsershot::url('https://brave.com/transparency/')->waitUntilNetworkIdle()->bodyHtml();
        dump($html);


        // $service = new BraveTransparencyService();
        // dump($service->dom);
        return view('welcome');
    }
}

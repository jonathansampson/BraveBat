<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use RuntimeException;

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
        dump('---');
        Bugsnag::notifyException(new RuntimeException("Test error"));
        return view('welcome');
    }
}

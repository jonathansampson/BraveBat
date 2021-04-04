<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Services\CreatorSearchService;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        $creator_count = Creator::creator_count();
        return view('welcome', compact('creator_count'));
    }

    public function privacy_policy()
    {
        return view('privacy_policy');
    }

    public function terms_of_service()
    {
        return view('terms_of_service');
    }

    public function search()
    {
        return view('search');
    }

    public function dashboard()
    {
        $searchable = Creator::searchable()->count();
        $indexStats = (new CreatorSearchService())->getStats();
        return view('dashboard', [
            'searchable' => $searchable,
            'indexStats' => $indexStats,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Services\CreatorSearchService;
use Illuminate\Support\Facades\DB;

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
        $vitalStats = DB::select("SELECT
            count(id) as 'Total',
            sum(case when confirmed_at is null then 1 else 0 end) as 'Not Confirmed',
            sum(case when last_processed_at is null then 1 else 0 end) as 'Not Processed',
            sum(case when last_processed_at is null and channel = 'website' then 1 else 0 end) as 'Not Processed Website',
            sum(case when last_processed_at is null and channel = 'youtube' then 1 else 0 end) as 'Not Processed Youtube',
            sum(case when last_processed_at is null and channel = 'twitch' then 1 else 0 end) as 'Not Processed Twitch',
            sum(case when last_processed_at is null and channel = 'vimeo' then 1 else 0 end) as 'Not Processed Vimeo',
            sum(case when last_processed_at is null and channel = 'github' then 1 else 0 end) as 'Not Processed Github',
            sum(case when last_processed_at is null and channel = 'twitter' then 1 else 0 end) as 'Not Processed Twitter',
            sum(case when name is null and channel != 'reddit' and valid = 1 then 1 else 0 end) as 'Valid Non-Reddit without Name',
            sum(case when ranking is null and channel != 'reddit' and valid = 1  then 1 else 0 end) as 'Valid Non-Reddit without Ranking'
            from creators
            ");
        return view('dashboard', [
            'searchable' => $searchable,
            'indexStats' => $indexStats,
            'vitalStats' => (array) $vitalStats[0],
        ]);
    }
}

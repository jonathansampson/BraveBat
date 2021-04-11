<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Repositories\CreatorStatsRepository;
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
        $creatorStats = (new CreatorStatsRepository())->creatorsByChannels();
        $creatorTotalCount = collect($creatorStats)->reduce(fn($c, $a) => $c + $a->total_today);
        $overall = (object) [
            'channel' => 'overall',
            'total_today' => $creatorTotalCount,
            'total_7d_ago' => collect($creatorStats)->reduce(fn($c, $a) => $c + $a->total_7d_ago),
            'total_1m_ago' => collect($creatorStats)->reduce(fn($c, $a) => $c + $a->total_1m_ago),
            'total_3m_ago' => collect($creatorStats)->reduce(fn($c, $a) => $c + $a->total_3m_ago),
            'total_1y_ago' => collect($creatorStats)->reduce(fn($c, $a) => $c + $a->total_1y_ago),
        ];
        array_unshift($creatorStats, $overall);
        return view('welcome', compact('creatorTotalCount', 'creatorStats'));
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

    public function api_doc()
    {
        return view('api_doc');
    }

    public function dashboard()
    {
        $searchable = Creator::searchable()->count();
        $indexStats = (new CreatorSearchService())->getStats();
        $vitalStats = DB::select("SELECT
            count(id) as 'Total',
            sum(case when confirmed_at is null then 1 else 0 end) as 'Not Confirmed',
            sum(case when last_processed_at is null and channel != 'reddit' then 1 else 0 end) as 'Not Processed (exclude Reddit)',
            sum(case when last_processed_at is null and channel = 'website' then 1 else 0 end) as 'Not Processed Website',
            sum(case when last_processed_at is null and channel = 'youtube' then 1 else 0 end) as 'Not Processed Youtube',
            sum(case when last_processed_at is null and channel = 'twitch' then 1 else 0 end) as 'Not Processed Twitch',
            sum(case when last_processed_at is null and channel = 'vimeo' then 1 else 0 end) as 'Not Processed Vimeo',
            sum(case when last_processed_at is null and channel = 'github' then 1 else 0 end) as 'Not Processed Github',
            sum(case when last_processed_at is null and channel = 'twitter' then 1 else 0 end) as 'Not Processed Twitter',

            sum(case when last_processed_at = current_date and channel = 'website' then 1 else 0 end) as 'Website Processed Today',
            sum(case when last_processed_at = current_date and channel = 'youtube' then 1 else 0 end) as 'Youtube Processed Today',
            sum(case when last_processed_at = current_date and channel = 'twitch' then 1 else 0 end) as 'Twitch Processed Today',
            sum(case when last_processed_at = current_date and channel = 'vimeo' then 1 else 0 end) as 'Vimeo Processed Today',
            sum(case when last_processed_at = current_date and channel = 'github' then 1 else 0 end) as 'Github Processed Today',
            sum(case when last_processed_at = current_date and channel = 'twitter' then 1 else 0 end) as 'Twitter Processed Today',

            sum(case when name is null and channel != 'reddit' and valid = 1 then 1 else 0 end) as 'Valid Non-Reddit without Name',
            sum(case when ranking is null and channel != 'reddit' and valid = 1  then 1 else 0 end) as 'Valid Non-Reddit without Ranking'
            from creators");
        return view('dashboard', [
            'searchable' => $searchable,
            'indexStats' => $indexStats,
            'vitalStats' => (array) $vitalStats[0],
        ]);
    }
}

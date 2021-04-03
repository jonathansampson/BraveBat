<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Services\CreatorSearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $term = $request->term;
        if ($term && strlen($term) >= 3) {
            return Creator::select('name', 'channel', 'id')
                ->where("valid", true)
                ->whereNotNull("name")
                ->whereNotNull('ranking')
                ->where('name', 'LIKE', '%' . $request->term . '%')
                ->orderBy('ranking', 'desc')
                ->take(10)
                ->get();
        }
    }

    public function meili(Request $request)
    {
        $term = $request->term;
        $channels = $request->channels;
        $service = new CreatorSearchService('creators');
        $results = $service->search($term, $channels);
        $hits = array_map(function ($hit) {
            return $hit['_formatted'];
        }, $results->getHits());

        $channels = $results->getFacetsDistribution()['channel'];
        ksort($channels);

        return response()->json([
            'hits' => $hits,
            'channels' => $channels,
        ]);

    }
}

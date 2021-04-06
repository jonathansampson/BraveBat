<?php

namespace App\Http\Controllers;

use App\Services\CreatorSearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        return view('search', ['initialTerm' => $request->term]);
    }

    public function store(Request $request)
    {
        $term = $request->term;
        $channels = $request->channels ? $request->channels : [];
        $offset = $request->offset ? $request->offset : 0;

        $service = new CreatorSearchService('creators');
        $results = $service->search($term, $channels, $offset);
        $hits = array_map(function ($hit) {
            return $hit['_formatted'];
        }, $results->getHits());
        $channels = $results->getFacetsDistribution()['channel'];
        ksort($channels);

        return response()->json([
            'hits' => $hits,
            'channels' => $channels,
            'nbHits' => $results->getNbHits(),
        ]);

    }
}

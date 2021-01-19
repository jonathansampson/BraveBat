<?php

namespace App\Http\Controllers;

use App\Models\Creator;
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

}

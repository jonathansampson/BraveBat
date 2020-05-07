<?php

namespace App\Http\Controllers\Api;

use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class GithubController extends Controller
{
    use ApiResponseTrait;
    /**
     * GitHub
     * Check if a GitHub account is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the Github 
     * link, use name, display name, description, the number of followers and the number of repos.
     * 
     * @bodyParam github_id string required The GitHub ID (example: "241138"). Notice this is not Github username that you might be familiar with. Example: 241138
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://github.com/karpathy",
     *     "name": "karpathy",
     *     "display_name": "Andrej",
     *     "description": "I like to train Deep Neural Nets on large datasets.",
     *     "followers": 24815,
     *     "repos": 35
     *   }
     * }
     * @response 422 {
     *   "success": false,
     *   "message": "Missing required field"
     * }
     * @response 404 {
     *   "success": false,
     *   "message": "Not found"
     * }
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'github_id' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }

        $creator = Creator::where('channel', 'github')
            ->where('channel_id', $request->github_id)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'name' => $creator->name,
                'display_name' => $creator->display_name,
                'description' => $creator->description,
                'followers' => $creator->follower_count,
                'repos' => $creator->repo_count,
            ]
        ], 200);
    }
}

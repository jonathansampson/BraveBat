<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 */
class WebsiteController extends Controller
{
    use ApiResponseTrait;
    /**
     * Website
     * Check if a website is a verified Brave Browser Creator. When it is confirmed, the endpoint returns the URL link,
     * alexa ranking and screenshot.
     *
     * @bodyParam url string required The URL of the website. Example: wikipedia.org
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https://wikipedia.org",
     *     "alexa_ranking": 10,
     *     "screenshot": "https://bravebat-prod.s3.us-west-2.amazonaws.com/website_screenshots/wikipedia_org.png"
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
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }
        $url = $request->url;
        $url = str_ireplace('http://', '', $url);
        $url = str_ireplace('https://', '', $url);
        $url = explode('/', $url)[0];

        $creator = Creator::where('channel', 'website')
            ->where('channel_id', $url)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'alexa_ranking' => $creator->alexa_ranking,
                'screenshot' => $creator->screenshot(),
            ],
        ], 200);
    }
}

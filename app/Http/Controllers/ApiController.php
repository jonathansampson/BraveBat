<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group v1
 *
 * APIs for verified Brave Browser Creator: v1
 */
class ApiController extends Controller
{
    /**
     * 
     * Get a website
     * 
     * @bodyParam url string required The URL of the website. Example: wikipedia.org
     * @response 200 {
     *   "success": true,
     *   "data": {
     *     "link": "https:\/\/wikipedia.org",
     *     "alexa_ranking": 10,
     *     "screenshot": "https:\/\/bravebat-prod.s3.us-west-2.amazonaws.com\/website_screenshots\/wikipedia_org.png"
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
    public function website(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            return self::missing_field_response();
        }
        $url = $request->url;
        $url = str_ireplace('http://', '', $url);
        $url = str_ireplace('https://', '', $url);
        $url = explode('/', $url)[0];

        $creator = Creator::where('channel', 'website')
            ->where('name', $url)
            ->first();

        if (!$creator) {
            return self::not_found();
        }

        return response()->json([
            'success' => true,
            'data' => [
                'link' => $creator->link,
                'alexa_ranking' => $creator->alexa_ranking,
                'screenshot' => $creator->screenshot()
            ]
        ], 200);
    }

    public static function missing_field_response()
    {
        return response()->json(['success' => false, 'message' => "Missing required field"], 422);
    }

    public static function not_found()
    {
        return response()->json(['success' => false, 'message' => "Not found"], 404);
    }
}

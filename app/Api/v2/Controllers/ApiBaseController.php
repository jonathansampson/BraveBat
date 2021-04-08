<?php

namespace App\Api\v2\Controllers;

use App\Http\Controllers\Controller;

class ApiBaseController extends Controller
{

}

/**
 * @OA\Info(
 *   title="BraveBat API",
 *   version="2.0",
 *   @OA\Contact(
 *     email="bravebatinfo@gmail.com"
 *   ),
 *  termsOfService="https: //bravebat.info/terms_of_service",
 *   @OA\License(
 *      name="Apache 2.0",
 *      url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *   )
 * )
 */

/**
 * @OA\Server(url="https://bravebat.info/api/v2/")
 * @OA\ExternalDocumentation(
 *     description="Find out more about BraveBat",
 *     url="https://bravebat.info"
 * )
 */

/**
 * @OA\Tag(
 *     name="Stats",
 *     description="Aggragated stats on Brave Browser, BAT token and related communities",
 * )
 * @OA\Tag(
 *     name="Creator",
 *     description="Verified Creator by Brave Browser",
 * )
 */

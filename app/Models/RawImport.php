<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawImport extends Model
{
    protected $table = 'raw_import';
    protected $guarded = [];

    /**
     * Handle input from Brave API
     *
     * @param $input
     * @return void
     */
    public static function handleInput($input)
    {
        $creator = trim($input[0]);
        $parts = explode('#channel:', $input[0]);
        if (count($parts) == 1) {
            $channel = 'website';
        } else {
            $channel = $parts[0];
        }

        self::updateOrCreate([
            'creator' => $creator
        ], [
            'channel' => $channel,
            'indicator1' => $input[1],
            'indicator2' => $input[2],
            'detail' => json_encode($input)
        ]);
    }
}

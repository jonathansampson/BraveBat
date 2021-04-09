<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreatorPrefix extends Model
{
    protected $table = "prefixes";
    use HasFactory;

    protected $guarded = [];

    public static function sync(array $newPrefixes)
    {
        $existingPrefixes = self::pluck('prefix')->toArray();
        $new = array_diff($newPrefixes, $existingPrefixes);
        $existing = array_intersect($newPrefixes, $existingPrefixes);
        self::whereIn('prefix', $existing)->update([
            'updated_at' => now(),
        ]);
        $data = [];
        foreach ($new as $element) {
            $data[] = [
                'prefix' => $element,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        self::insert($data);
    }
}

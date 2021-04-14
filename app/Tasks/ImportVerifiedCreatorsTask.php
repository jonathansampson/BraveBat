<?php

namespace App\Tasks;

use App\Models\Creator;
use App\Services\BraveProtoApiService;
use Carbon\Carbon;
use Throwable;

class ImportVerifiedCreatorsTask
{
    public function handle($prefixes)
    {
        $service = new BraveProtoApiService();
        foreach ($prefixes as $prefix) {
            try {
                $channels = $service->getChannels($prefix);
                Creator::handleIncomings($channels);
            } catch (Throwable $e) {
                report($e);
                return false;
            }
            sleep(1);
        }
    }

    public function generatePrefixes()
    {
        $options = str_split("0123456789abcdef");
        $prefixes = [];
        foreach ($options as $a) {
            foreach ($options as $b) {
                foreach ($options as $c) {
                    foreach ($options as $d) {
                        $prefixes[] = $a . $b . $c . $d;
                    }
                }
            }
        }
        $date = Carbon::parse('2020-01-02');
        $today = Carbon::today();

        $index = $date->diffInDays($today) % 8;
        $chunkedPrefixes = array_chunk($prefixes, 8192);
        return $chunkedPrefixes[$index];
    }
}

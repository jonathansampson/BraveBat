<?php

use App\Models\Community;
use App\Tasks\GenerateCreateDailyStatsFromBatWatch;
use App\Tasks\UpdateCreatorDailyStats;
use Illuminate\Support\Facades\Artisan;

Artisan::command('creator_daily_stats:update', function () {
    UpdateCreatorDailyStats::invalidPercent();
    UpdateCreatorDailyStats::topCreators();
})->describe('Update Creator Daily Stats');

Artisan::command('communities:generate', function () {
    Community::generate();
})->describe('Generate Communities');

Artisan::command('temp:backfill_creator_daily_stats', function () {
    $channels = ['youtube', 'twitter', 'vimeo', 'reddit', 'twitch', 'website', 'github'];
    foreach ($channels as $channel) {
        (new GenerateCreateDailyStatsFromBatWatch())->backfill($channel, '2020-06-18', '2020-10-29');
    }
})->describe('Temporary backfill daily creator stats data');

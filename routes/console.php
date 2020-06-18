<?php

use App\Tasks\UpdateCreatorDailyStats;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('creator_daily_stats:update', function () {
    UpdateCreatorDailyStats::invalidPercent();
    UpdateCreatorDailyStats::topCreators();
})->describe('Update Creator Daily Stats');

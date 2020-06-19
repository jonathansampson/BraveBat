<?php

use App\Models\Community;
use App\Tasks\UpdateCreatorDailyStats;
use Illuminate\Support\Facades\Artisan;

Artisan::command('creator_daily_stats:update', function () {
    UpdateCreatorDailyStats::invalidPercent();
    UpdateCreatorDailyStats::topCreators();
})->describe('Update Creator Daily Stats');

Artisan::command('communties:generate', function () {
    Community::generate();
})->describe('Generate Communities');

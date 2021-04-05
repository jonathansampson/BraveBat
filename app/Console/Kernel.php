<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {})->everyTenMinutes()->thenPing(config('bravebat.heartbeat'));

        $schedule->command('horizon:snapshot')->hourly();
        $schedule->command('import:transparency')->hourly();
        $schedule->command('bat_stats:generate')->dailyAt('00:01');
        $schedule->command('communities:generate')->dailyAt('00:02');
        $schedule->command('sitemap:generate')->dailyAt("00:03");

        $schedule->command('import:creator')->dailyAt("00:00");
        $schedule->command('creator:process')->dailyAt("04:00");

        // $schedule->command('creator_daily_stats:generate')->dailyAt('15:00');
        $schedule->command('creator_daily_stats:update')->dailyAt('19:00');

        $schedule->command('creator:rank')->dailyAt('11:55');
        // Tweet
        $schedule->command('milestone:tweet')->dailyAt('6:55');
        $schedule->command('top_creator:tweet website 0.0005')->dailyAt('12:55');
        $schedule->command('top_creator:tweet youtube 0.005')->dailyAt('13:55');
        $schedule->command('top_creator:tweet twitch 0.005')->dailyAt('14:55');
        $schedule->command('top_creator:tweet twitter 0.01')->dailyAt('15:55');
        $schedule->command('top_creator:tweet github 0.01')->dailyAt('16:55');
        $schedule->command('top_creator:tweet vimeo 0.02')->dailyAt('17:55');

        // Monthly
        $schedule->command('creator_stats:generate')->monthlyOn(2, '15:00');

        // index creators
        $schedule->command('creators_search:refresh_index')->dailyAt('14:30');

        // $schedule->command('prefix:generate')->dailyAt('14:05');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}

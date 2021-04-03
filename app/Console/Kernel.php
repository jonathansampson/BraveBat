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

        // $schedule->command('backfill:all')->dailyAt("09:00");

        $schedule->command('creator:rank')->dailyAt('18:00');
        $schedule->command('creator_daily_stats:update')->dailyAt('19:00');

        $schedule->command('import:creator')->dailyAt("00:01");

        // $schedule->command('backfill:website')->dailyAt("5:41"); // 8000
        $schedule->command('backfill:twitter')->dailyAt("5:42"); // 10000
        $schedule->command('backfill:vimeo')->dailyAt("7:43"); // 10000
        $schedule->command('backfill:twitch')->dailyAt("9:44"); // 10000
        $schedule->command('backfill:github')->dailyAt("11:45"); // 15000
        $schedule->command('backfill:youtube')->dailyAt("13:46"); // 20000
        // $schedule->command('creator:rank')->dailyAt('14:00');
        // $schedule->command('creator_daily_stats:generate')->dailyAt('15:00');

        // Tweet
        $schedule->command('milestone:tweet')->dailyAt('6:55');

        $schedule->command('top_creator:tweet website 0.0005')->dailyAt('7:55');
        $schedule->command('top_creator:tweet youtube 0.005')->dailyAt('8:55');
        $schedule->command('top_creator:tweet twitch 0.005')->dailyAt('9:55');
        $schedule->command('top_creator:tweet twitter 0.01')->dailyAt('10:55');
        $schedule->command('top_creator:tweet github 0.01')->dailyAt('11:55');
        $schedule->command('top_creator:tweet vimeo 0.02')->dailyAt('12:55');

        // Monthly
        $schedule->command('creator_stats:generate')->monthlyOn(2, '15:00');
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

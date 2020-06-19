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
        $schedule->command('horizon:snapshot')->hourly();
        $schedule->command('import:transparency')->dailyAt("00:00");
        $schedule->command('bat_stats:generate')->dailyAt('00:01');
        $schedule->command('communities:generate')->dailyAt('00:02');

        $schedule->command('sitemap:generate')->dailyAt("01:00");

        $schedule->command('import:creator')->dailyAt("00:01");
        $schedule->command('backfill:website')->dailyAt("03:41"); // 8000
        $schedule->command('backfill:twitter')->dailyAt("03:42"); // 10000
        $schedule->command('backfill:vimeo')->dailyAt("03:43"); // 10000
        $schedule->command('backfill:twitch')->dailyAt("03:44"); // 10000
        $schedule->command('backfill:github')->dailyAt("03:45"); // 15000
        $schedule->command('backfill:youtube')->dailyAt("03:46"); // 20000
        $schedule->command('creator:rank')->dailyAt('6:00');
        $schedule->command('creator_daily_stats:generate')->dailyAt('7:00');
        $schedule->command('creator_daily_stats:update')->dailyAt('19:00');

        // $schedule->command('import:creator')->dailyAt("10:18");
        // $schedule->command('backfill:website')->dailyAt("11:41"); // 8000
        // $schedule->command('backfill:twitter')->dailyAt("11:42"); // 10000
        // $schedule->command('backfill:vimeo')->dailyAt("11:43"); // 10000
        // $schedule->command('backfill:twitch')->dailyAt("11:44"); // 10000
        // $schedule->command('backfill:github')->dailyAt("11:45"); // 15000
        // $schedule->command('backfill:youtube')->dailyAt("11:46"); // 1900
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
        $schedule->command('creator_stats:generate')->monthlyOn(4, '15:00');
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

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
        $schedule->command('import:bat_transparency')->daily();

        $schedule->command('backfill:website')->dailyAt("12:50"); // 500
        $schedule->command('backfill:twitter')->dailyAt("12:51"); // 5000
        $schedule->command('backfill:vimeo')->dailyAt("13:15"); // 5000
        $schedule->command('backfill:twitch')->dailyAt("12:53"); // 5000

        // $schedule->command('backfill:youtube')->dailyAt("04:15"); // 2000
        // $schedule->command('creator:rank')->dailyAt("18:35");
        // $schedule->command('import:bat_creator')->dailyAt("12:00");
        // $schedule->command('sitemap:generate')->daily();
        // $schedule->command('telescope:prune')->daily();

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

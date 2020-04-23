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
        $schedule->command('telescope:prune')->daily();
        $schedule->command('import:bat_transparency')->daily();
        $schedule->command('sitemap:generate')->daily();
        $schedule->command('import:bat_creator')->dailyAt("04:03");

        $schedule->command('backfill:website')->dailyAt("00:10"); // 5000
        $schedule->command('backfill:twitter')->dailyAt("00:11"); // 5000
        $schedule->command('backfill:vimeo')->dailyAt("00:12"); // 5000
        $schedule->command('backfill:twitch')->dailyAt("00:13"); // 5000

        $schedule->command('backfill:youtube')->dailyAt("04:15"); // 2000
        $schedule->command('creator:rank')->dailyAt("18:35");
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

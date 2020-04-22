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

        $schedule->command('backfill:website')->dailyAt("16:30");
        $schedule->command('backfill:twitter')->dailyAt("16:35");
        $schedule->command('backfill:vimeo')->dailyAt("18:00");
        $schedule->command('backfill:twitch')->dailyAt("16:45");

        // $schedule->command('backfill:youtube')->dailyAt("04:03");
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

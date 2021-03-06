<?php

namespace App\Console\Commands;

use App\Models\Stats\CreatorDailyStats;
use Illuminate\Console\Command;

class TweetCreatorMilestonesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'milestone:tweet';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet Milestones';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CreatorDailyStats::channelTweet();
        CreatorDailyStats::overallTweet();
    }
}

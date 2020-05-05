<?php

namespace App\Console\Commands;

use App\Models\Creator;
use Illuminate\Console\Command;

class TweetTopCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'top_creator:tweet {channel}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tweet Top Creators';

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
        $channel = $this->argument('channel');
        Creator::tweet($channel);
    }
}

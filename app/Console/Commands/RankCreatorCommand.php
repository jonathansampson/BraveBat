<?php

namespace App\Console\Commands;

use App\Models\Creators\Twitch;
use Illuminate\Console\Command;
use App\Models\Creators\Twitter;
use App\Models\Creators\Vimeo;
use App\Models\Creators\Website;
use App\Models\Creators\Youtube;

class RankCreatorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'creator:rank';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Website::rank();
        Youtube::rank();
        Twitter::rank();
        Twitch::rank();
        Vimeo::rank();
    }
}

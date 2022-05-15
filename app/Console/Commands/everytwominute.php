<?php

namespace App\Console\Commands;

use App\Models\smsping;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

class everytwominute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will delete ping';

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
     * @return int
     */
    public function handle()
    {
        $result=smsping::where('created_at','<',Carbon::now()->subMinutes(2))->delete();
        if($result)
        {
            echo "deleted";
        }
        else
        {
            echo "error";
        }
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\AspirantActivation;
use Carbon\Carbon;
class DeleteExpiredCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete-expired-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Delete aspirant's activation codes older than 24 hours";

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
        //
        $this->deleteExpiredCodes();
    }

    public function deleteExpiredCodes()
    {

        AspirantActivation::where('created_at', '<=', Carbon::now()->subHours(24))->delete();

    }
}

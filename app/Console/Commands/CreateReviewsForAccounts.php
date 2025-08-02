<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Account;
use App\Models\Voucher;
use App\Models\AccountReview;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CreateReviewsForAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:accounts_reviews';

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
     * @return int
     */
    public function handle()
    {
        $accounts = Account::all();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        AccountReview::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($accounts as $account) {
            if (!$account->reviews) {
                $account->review()->create(['year' => Carbon::now()->format('Y')]);
            }
        }
        foreach (Voucher::get() as $v) {
            $v->accounts()->update(['parent_date' => $v->date]);
        }
    }
}

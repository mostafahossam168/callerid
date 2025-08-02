<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class FixPaidTax extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix_paidtax';

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
        $invoices = Invoice::where('tax', '>', 0)->get();
        foreach ($invoices as $invoice) {
            $paidWithOutTax = ($invoice->paid * 100) / (100 + setting()->tax_rate);
            $paidTax = $invoice->paid - $paidWithOutTax;
            $invoice->update(['paid_tax' => round($paidTax, 2), 'paid_without_tax' => round($paidWithOutTax, 2)]);
        }
    }
}

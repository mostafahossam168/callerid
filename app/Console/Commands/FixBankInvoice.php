<?php

namespace App\Console\Commands;

use App\Models\Invoice;
use Illuminate\Console\Command;

class FixBankInvoice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-bank-invoice';

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
        $invoices = Invoice::where('status', 'bank_transfer')->get();
        foreach ($invoices as $invoice) {
            if ($invoice->bank == 0) {
                $invoice->bank = $invoice->total;
                $invoice->cash = 0;
                $invoice->card = 0;
            }
            $invoice->status = 'Paid';
            $invoice->save();
        }

        $invoices = Invoice::where('status', 'cash')->get();
        foreach ($invoices as $invoice) {
            if ($invoice->cash == 0) {
                $invoice->cash = $invoice->total;
                $invoice->card = 0;
                $invoice->bank = 0;
            }
            $invoice->status = 'Paid';
            $invoice->save();
        }
        $invoices = Invoice::where('status', 'card')->get();
        foreach ($invoices as $invoice) {
            if ($invoice->card == 0) {
                $invoice->card = $invoice->total;
                $invoice->cash = 0;
                $invoice->bank = 0;
            }
            $invoice->status = 'Paid';
            $invoice->save();
        }
        $invoices = Invoice::where('status', 'cash')->get();
        foreach ($invoices as $invoice) {
            $invoice->update(['cash' => $invoice->paid, 'status' => 'Paid', 'card' => 0, 'bank' => 0]);
        }
        $invoices = Invoice::where('status', 'card')->get();
        foreach ($invoices as $invoice) {
            $invoice->update(['card' => $invoice->paid, 'status' => 'Paid', 'bank' => 0, 'cash' => 0]);
        }
    }
}

<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Console\Command;

class FixInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-invoices';

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
        $invoices = Invoice::all();
        $counter = 0;

        foreach ($invoices as $invoice) {
            $items = $invoice->items;
            $taxes = 0;

            foreach ($items as $item) {
                if ($item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $quantity = $item->quantity ?? 1;
                        $price = $product->price;
                        $tax_rate = setting()->tax_rate ?? 0;
                        $tax = $product->tax_enabled ? ($price * $quantity * ($tax_rate / 100)) : 0;

                        $item->update([
                            'price' => $price,
                            'tax' => $tax,
                            'sub_total' => ($price * $quantity) + $tax
                        ]);
                    }
                }
            }

            $total_amount = $invoice->items->sum('price');
            $taxes = $invoice->items->sum('tax');

            $totals = $total_amount + $taxes  - ($invoice->discount ?? 0) - ($invoice->offers_discount ?? 0);

            $paidTax = 0;
            $paidTotal = $totals;
            if ($invoice->tax > 0) {
                $paidTotal = $totals - $taxes;
                $paidTax = $taxes;
            }

            $invoice->update([
                'total' => $totals,
                'tax' => $taxes,
                'amount' => $total_amount,
                //'cash' => $invoice->cash > 0 ? $totals : 0,
                //'card' => $invoice->card > 0 ? $totals : 0,
                //'bank' => $invoice->bank > 0 ? $totals : 0,
                'paid_tax' => $paidTax,
                'paid_without_tax' => $paidTotal,
                'rest' => $totals - $invoice->paid
            ]);

            $counter++;
        }

        echo $counter;
    }
}

<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Product;
use Illuminate\Console\Command;

class FixOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-old-items';

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
        $items = Product::all();
        $tax_rate = setting()->tax_rate;
        $counter = 0;
        foreach ($items as $item) {
            if ($item->has_tax) {
                $item->update(['price' => $this->findOriginalNumber($item->price, $tax_rate)]);
                $counter++;
            }
        }
        return $counter;
    }

    public function findOriginalNumber($total, $tax_rate)
    {
        return round(($total * (100 + $tax_rate)) / 100);
    }
}

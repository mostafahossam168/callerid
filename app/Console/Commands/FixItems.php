<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\ItemQuantity;
use Illuminate\Console\Command;

class FixItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:items';

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
        $items = Item::get();
        $warehouse = Warehouse::first();
        if (!$warehouse) {
            $warehouse = Warehouse::create(['name' => 'المستودع الرئيسي']);
        }
        $counter = 0;
        foreach ($items as $item) {
            ItemQuantity::create([
                'item_id' => $item->id,
                'warehouse_id' => $warehouse->id,
                'quantity' => $item->quantity ?? 0,
                'type' => 'charge',
                'employee_id' => 1,
                'last_update' => 1,
            ]);
            $counter++;
        }
        $user = User::first(); // get admin
        $user->update(['warehouse_id' => $warehouse->id]); // set warehouse_id to user fix items

        echo $counter;
    }
}

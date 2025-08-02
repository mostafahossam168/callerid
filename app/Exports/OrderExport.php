<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Supply;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class OrderExport implements FromView
{
    public $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function view(): View
    {
        $all_orders= Order::all();
        return view('exports.orders', [
            'orders' => $this->orders,
            'all_orders' => $all_orders
        ]);
    }
}

<?php

namespace App\Http\Livewire\Reports;

use App\Models\Order;
use Livewire\Component;

class SalesReport extends Component
{
    public $filter_status, $to, $from;
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $orders = Order::where(function ($q) {
            $this->between($q);
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
            }
        })->get();
        return view('livewire.reports.sales-report', compact('orders'));
    }
}

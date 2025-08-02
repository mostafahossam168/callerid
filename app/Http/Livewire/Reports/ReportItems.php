<?php

namespace App\Http\Livewire\Reports;

use App\Models\Item;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class ReportItems extends Component
{

    public $item, $from, $to;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
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
    public function mount()
    {
        $this->item = Item::findOrFail(request('item'));
    }
    public function render()
    {
        $orders = Order::whereRelation('items', 'item_id', $this->item->id)->where(function ($q) {
            $this->between($q);
        })->latest()->paginate();

        return view('livewire.reports.report-items', compact('orders'));
    }
}

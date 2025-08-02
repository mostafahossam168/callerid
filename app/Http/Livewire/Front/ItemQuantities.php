<?php

namespace App\Http\Livewire\Front;

use App\Models\Item;
use Livewire\Component;

class ItemQuantities extends Component
{
    public $item;

    public $from, $to;

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


    public function mount(Item $item)
    {
        $this->item = $item;
    }

    public function render()
    {
        $all_expenses = $this->item->all_quantities()->where('type', 'expense')->where(function ($q) {
            $this->between($q);
        })->get();
        $all_charges = $this->item->all_quantities()->where('type', 'charge')->where(function ($q) {
            $this->between($q);
        })->get();

        return view('livewire.front.item-quantities', compact('all_charges', 'all_expenses'));
    }
}

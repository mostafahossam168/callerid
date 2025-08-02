<?php

namespace App\Http\Livewire\CostCenters;

use App\Models\CostCenter;
use App\Models\VoucherAccount;
use Livewire\Component;

class Show extends Component
{
    public $cost_center, $from, $to, $search, $voucher_id;

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('date', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function render()
    {
        $voucher_accounts = $this->cost_center->accounts()->when($this->search, function ($q) {
            $q->where('description', 'LIKE', "%$this->search%");
        })->when($this->voucher_id, function ($q) {
            $q->where('voucher_id', 'LIKE', "%$this->voucher_id%");
        })->where(function ($q) {
            $q->whereHas('voucher', function ($query) {
                $this->between($query);
            });
        })->get();

        return view('livewire.cost-centers.show', compact('voucher_accounts'));
    }
}

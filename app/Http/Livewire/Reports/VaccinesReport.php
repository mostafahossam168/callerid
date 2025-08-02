<?php

namespace App\Http\Livewire\Reports;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Vaccine;
use Livewire\Component;
use Livewire\WithPagination;

class VaccinesReport extends Component
{

    public $vaccine, $from, $to;
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
        $this->vaccine = Vaccine::findOrFail(request('vaccine'));
    }

    public function render()
    {
        $invoices = Invoice::whereRelation('items', 'vaccine_id', $this->vaccine->id)
            ->where(function ($q) {
            $this->between($q);
        })->latest()->paginate();
        return view('livewire.reports.vaccines-report', compact('invoices'))
            ->extends('front.layouts.front')
            ->section('content')
            ;
    }

}

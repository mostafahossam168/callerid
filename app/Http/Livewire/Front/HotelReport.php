<?php

namespace App\Http\Livewire\Front;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class HotelReport extends Component
{
    public $filter, $notes;

    public function render()
    {
        $invoices = Invoice::whereRelation('department', 'is_hotel_service', 1)
            ->where(function (Builder $query) {
                if ($this->filter == 'present') {
                    $query->where('departure_date', '>=', date('Y-m-d'));
                } elseif ($this->filter == 'left') {
                    $query->where('departure_date', '<', date('Y-m-d'));
                }
            })
            ->latest()
            ->paginate(10);

        $present = Invoice::whereRelation('department', 'is_hotel_service', 1)
            ->where('departure_date', '>=', date('Y-m-d'))
            ->count();

        $left = Invoice::whereRelation('department', 'is_hotel_service', 1)
            ->where('departure_date', '<', date('Y-m-d'))
            ->count();

        return view('livewire.front.hotel-report', compact('invoices', 'present', 'left'))
            ->extends('front.layouts.front')
            ->section('content');
    }

    public function saveNotes(Invoice $invoice)
    {
        $this->validate(['notes' => 'required']);

        $invoice->update(['notes' => $this->notes]);

        $this->reset('notes');

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }

    public function getNotes(Invoice $invoice)
    {
        $this->notes = $invoice->notes;
    }
}

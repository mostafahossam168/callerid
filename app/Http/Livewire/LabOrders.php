<?php

namespace App\Http\Livewire;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;

class LabOrders extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $invoice_data, $filter;

    public function render()
    {
        $invoices = Invoice::lab()->where(function ($q) {
            if ($this->filter == 'new') {
                $q->whereNull('lab_user_id');
            }
            if ($this->filter == 'old') {
                $q->whereNotNull('lab_user_id');
            }
            if ($this->filter == 'all') {
                return $q;
            }
        })->latest()->paginate(10);
        $all_invoices = Invoice::lab()->get();
        return view('livewire.lab-orders', compact('invoices', 'all_invoices'));
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function getItem(Invoice $invoice)
    {
        $this->invoice_data = $invoice;
    }
}

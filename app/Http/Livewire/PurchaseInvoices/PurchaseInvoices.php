<?php

namespace App\Http\Livewire\PurchaseInvoices;

use App\Models\PurchaseInvoice;
use Livewire\Component;

class PurchaseInvoices extends Component
{
    public $invoice_data;

    public function render()
    {
        $purchase_invoices = PurchaseInvoice::paginate(10);
        return view('livewire.purchase-invoices.purchase-invoices', compact('purchase_invoices'))->extends('front.layouts.front')->section('content');
    }

    public function afterSubmit()
    {
        $this->obj->items()->delete();
        $this->obj->items()->createMany($this->items);
    }

    public function invoiceId($id)
    {
        $this->invoice_data = PurchaseInvoice::find($id);
    }

    public function delete()
    {
        $this->invoice_data->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحذف بنجاح']);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Analysis as ModelsAnalysis;
use App\Models\InvoiceItem;
use Livewire\Component;

class Analysis extends Component
{
    public $invoice_item, $form, $results = [], $invoice;

    public function render()
    {
        return view('livewire.analysis');
    }

    public function mount(InvoiceItem $invoice_item)
    {
        $this->invoice_item = $invoice_item;
        $this->invoice = $invoice_item->invoice;
        if ($invoice_item->analysis) {
            $this->form = $invoice_item->analysis->form;
            $this->results = $invoice_item->analysis->results;
        }
    }

    public function save()
    {
        $this->validate([
            'form' => 'required',
            'results' => 'required'
        ]);

        ModelsAnalysis::updateOrCreate([
            'invoice_item_id' => $this->invoice_item->id,
        ], [
            'patient_id' => $this->invoice_item->invoice->patient_id,
            'product_id' => $this->invoice_item->product_id,
            'animal_id' => $this->invoice_item->invoice->animal_id,
            'user_id' => auth()->user()->id,
            'results' => $this->results,
            'form' => $this->form,

        ]);

        $this->invoice->update(['lab_user_id' => auth()->user()->id]);

        return redirect()->route('lab.requests')->with('success', 'تم اضافة التحليل بنجاح.');
    }
}

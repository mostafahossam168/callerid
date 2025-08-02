<?php

namespace App\Http\Livewire;

use App\Exports\MedicinesExport;
use App\Imports\MedicinesImport;
use App\Models\Medicine;
use App\Models\PharmacyRequest;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Medicines extends Component
{
    public $medicine, $name_ar, $name_en, $selling_price, $cost_price, $selling_price_with_tax, $file, $screen = 'index', $search;
    public $to, $from;
    use WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        if ($this->medicine) {
            return [
                'name_ar' => 'required|unique:medicines,name_ar,' . $this->medicine->id . ',id',
                'name_en' => 'required|unique:medicines,name_en,' . $this->medicine->id . ',id',
                'selling_price' => 'required|numeric',
                'cost_price' => 'required|numeric',
                'selling_price_with_tax' => 'required|numeric',
            ];
        } else {
            return [
                'name_ar' => 'required|unique:medicines,name_ar',
                'name_en' => 'required|unique:medicines,name_en',
                'selling_price' => 'required|numeric',
                'cost_price' => 'required|numeric',
                'selling_price_with_tax' => 'required|numeric',
            ];
        }
    }

    public function edit(Medicine $medicine)
    {
        $this->name_ar = $medicine->name_ar;
        $this->name_en = $medicine->name_en;
        $this->selling_price = $medicine->selling_price;
        $this->cost_price = $medicine->cost_price;
        $this->selling_price_with_tax = $medicine->selling_price_with_tax;
        $this->medicine = $medicine;
        $this->screen = 'edit';
    }

    public function save()
    {
        $data = $this->validate();
        if ($this->medicine) {
            $this->medicine->update($data);
        } else {
            Medicine::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Medicine $medicine)
    {
        $medicine->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }
    public function updatedScreen()
    {
        if ($this->screen == 'index') {
            $this->reset();
        }
    }


    public function import()
    {
        $this->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new MedicinesImport, $this->file);

        //$this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);

        return redirect()->route('front.medicines.index')->with('success', __('Saved successfully'));
    }

    public function export()
    {
        return Excel::download(new MedicinesExport, 'medicines' . time() . '.xlsx');
    }

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
        $medicines = Medicine::when($this->search, function ($q) {
            $q->where('name_ar', 'LIkE', '%' . $this->search . '%')->orWhere('name_en', 'LIkE', '%' . $this->search . '%');
        })->paginate(10);

        $requests = PharmacyRequest::where(function ($q) {
            $this->between($q);
        })->where('status', 'paid')->pluck('paid_drugs');

        $ids = collect($requests)->collapse();

        return view('livewire.medicines', compact('medicines', 'requests', 'ids'));
    }
}

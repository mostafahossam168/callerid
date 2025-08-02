<?php

namespace App\Http\Livewire\Front;

use App\Models\PharmacyMedicine;
use App\Models\PharmacyQuantity;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PharmacyQuantities extends Component
{
    public $pharmacyMedicine, $search,$type;

    public function render()
    {
        $quantities = PharmacyQuantity::withTrashed()->where(function (Builder $query) {
            if ($this->pharmacyMedicine){
                $query->where('item_id',$this->pharmacyMedicine->id);
            }
            if ($this->search){
                $query->where('operational_number',$this->search);
            }
            if ($this->type){
                $query->where('type',$this->type);
            }
        })->latest()
            ->paginate(10);
        return view('livewire.front.pharmacy-quantities', compact('quantities'))
            ->extends('front.layouts.front')
            ->section('content')
            ;
    }

    public function mount(PharmacyMedicine $item = null)
    {
        if ($item){
            $this->pharmacyMedicine = $item;
        }
    }

    public function delete(PharmacyQuantity $item)
    {
        $item->delete();
    }

}

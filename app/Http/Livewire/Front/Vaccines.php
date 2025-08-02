<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Vaccine;
use App\Traits\livewireResource;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Vaccines extends Component
{
    use livewireResource;
    public $search;
    public $name,
        $price,
        $tax_enabled=0,
        $category_id,
        $discount_rate;

    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'tax_enabled' => 'nullable',
            'category_id' => 'required',
            'discount_rate' => 'nullable',
        ];
    }

    public function render()
    {
        $vaccines = Vaccine::where(function (Builder $query) {
            if ($this->search){
                $query->where('name','like',"%$this->search%");
            }
        })->latest()->paginate(10);
        $categories =Category::get();
        return view('livewire.front.vaccines',compact('vaccines','categories'));
    }
}

<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\ItemCategory;
use App\Traits\livewireResource;
use Illuminate\Database\Eloquent\Builder;

class ItemCategories extends Component
{
    use livewireResource;

    public $name, $parent_id, $search;

    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable'
        ];
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function render()
    {
        $parents = ItemCategory::whereNull('parent_id')->where(function ($q) {
            if ($this->obj) {
                $q->where('id', '<>', $this->obj->id);
            }
        })->latest()->get();
        $categories = ItemCategory::where(function (Builder $query) {
            if ($this->search) {
                $query->where('name', 'like', "%$this->search%");
            }
        })
            ->latest()
            ->paginate(10);

        return view('livewire.front.item-categories', compact('parents', 'categories'))
            ->extends('front.layouts.front')
            ->section('content');
    }

    public function beforeSubmit()
    {
        $this->data['parent_id'] =  $this->data['parent_id'] ?  $this->data['parent_id'] : null;
    }
}

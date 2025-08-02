<?php

namespace App\Http\Livewire\CostCenters;

use App\Models\CostCenter;
use App\Traits\livewireResource;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, livewireResource;

    protected function rules()
    {
        return [
            'name' => 'required|max:191',
            'parent_id' => 'nullable',
        ];
    }

    public $name, $parent_id, $center, $search, $screen = 'index', $filter_id;

    public function render()
    {
        $centers = CostCenter::withCount(['subCenters'])->where(function ($q) {
            if ($this->filter_id) {
                $q->where('parent_id', $this->filter_id);
            } else {
                $q->whereNull('parent_id');
            }
        })->latest()->paginate(10);
        $all_centers = CostCenter::get(['id', 'name']);
        return view('livewire.cost-centers', compact('centers', 'all_centers'));
    }


    public function edit(CostCenter $center)
    {
        $this->name = $center->name;
        $this->parent_id = $center->parent_id;
        $this->center = $center;
        $this->screen = 'edit';
    }

    public function submit()
    {
        $data = $this->validate();
        if ($this->center) {
            $this->center->update($data);
        } else {
            CostCenter::create($data);
        }
        $this->reset();
        $this->screen = 'index';
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
    }


    public function delete(CostCenter $center)
    {
        $center->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحذف بنجاح']);
    }
}

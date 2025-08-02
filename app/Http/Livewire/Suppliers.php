<?php

namespace App\Http\Livewire;

use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Traits\livewireResource;
use Livewire\Component;

class Suppliers extends Component
{
    use livewireResource;

    public $name, $address, $phone, $tax_no, $warehouse_id;

    public function rules()
    {
        return [
            'name' => 'required',
            'address' => 'nullable',
            'phone' => 'nullable',
            'tax_no' => 'nullable',
            'warehouse_id' => 'required',
        ];
    }




    public function validationAttributes()
    {
        return [
            'warehouse_id' => __('Warehouse')
        ];
    }

    public function mount()
    {
        $this->model = 'App\Models\Supplier';
    }


    public function submit()
    {
        $this->data = $this->validate();
        $this->beforeSubmit();
        if ($this->obj) {
            $this->beforeUpdate();
            $this->obj->update($this->data);
            $this->afterUpdate();
            $this->afterSubmit();
            $this->obj = null;
            $this->resetInputs();
            $this->screen = 'index';
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم التعديل بنجاح']);
        } else {
            $this->beforeCreate();
            $this->model::create($this->data);
            $this->afterCreate();
            $this->afterSubmit();
            $this->obj = null;
            $this->resetInputs();
            $this->screen = 'index';
            $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم الحفظ بنجاح']);
        }
    }



    public function render()
    {
        $suppliers = Supplier::paginate(10);
        $warehouses = Warehouse::all();
        return view('livewire.suppliers', compact('suppliers', 'warehouses'));
    }
}
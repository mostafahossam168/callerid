<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kind;
use App\Models\Supply;
use Livewire\Component;
use Livewire\WithPagination;

class Supplies extends Component
{


    public $name, $main_cat, $kind_id, $quantity, $purchase_price, $supply;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name' => 'required',
            'main_cat' => 'required',
            'kind_id' => 'required',
            'quantity' => 'required|integer',
            'purchase_price' => 'required|numeric',
        ];
    }

    public function edit(Supply $supply)
    {
        $this->name = $supply->name;
        $this->quantity = $supply->quantity;
        $this->purchase_price = $supply->purchase_price;
        $this->main_cat = $supply->kind->main->id;
        $this->kind_id = $supply->kind_id;
        $this->supply = $supply;
    }
    public function save()
    {
        $data = $this->validate();
        unset($data['main_cat']);
        if ($this->supply) {
            $this->supply->update($data);
        } else {
            Supply::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Supply $supply)
    {
        $supply->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $supplies = Supply::with('kind')->latest()->paginate(10);
        $main_cats = Kind::get();
        // $main_cats = Kind::whereNull('parent')->get();
        $sub_cats = Kind::whereParent($this->main_cat)->get();

        return view('livewire.admin.supplies', compact('supplies', 'main_cats', 'sub_cats'));
    }
}
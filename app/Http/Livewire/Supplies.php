<?php

namespace App\Http\Livewire;

use App\Exports\SupplyExport;
use App\Models\Department;
use App\Models\Kind;
use App\Models\Supply;
use App\Models\SupplyQuantity;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Supplies extends Component
{
    public $name, $selling_price, $main_cat, $kind_id, $quantity, $purchase_price, $supply, $price, $clinic_id, $doctor_id, $open_quantity;

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
            'open_quantity' => $this->supply ? 'required' : 'nullable',
            //'selling_price' => 'required|gt:purchase_price'
        ];
    }

    public function edit(Supply $supply)
    {
        $this->name = $supply->name;
        $this->quantity = $supply->quantity;
        $this->purchase_price = $supply->purchase_price;
        //$this->selling_price = $supply->selling_price;
        $this->main_cat = $supply->kind->main->id;
        $this->kind_id = $supply->kind_id;
        $this->supply = $supply;
        $this->open_quantity = $supply->open_quantity;
    }


    public function export()
    {
        return Excel::download(new SupplyExport, 'supplies' . time() . '.xlsx');
    }

    public function save()
    {
        $data = $this->validate();
        unset($data['main_cat']);
        if ($this->supply) {
            $this->supply->update($data);
        } else {
            $data['open_quantity'] = $this->quantity;

            $supply = Supply::create($data);

            SupplyQuantity::create([
                'supply_id' => $supply->id,
                'quantity' => $this->quantity,
                'price' => $this->quantity * $supply->purchase_price,
                'type' => 'in',
            ]);
        }

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function delete(Supply $supply)
    {
        $supply->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $doctors = User::doctors()->get();
        $clinics = Department::get();
        $supplies = Supply::with('kind')->latest()->paginate(10);
        $main_cats = Kind::whereNull('parent')->get();
        $sub_cats = Kind::whereParent($this->main_cat)->get();

        return view('livewire.supplies', compact('supplies', 'main_cats', 'sub_cats', 'doctors', 'clinics'));
    }


    public function updateQuantity(Supply $supply)
    {
        $this->supply = $supply;
    }

    public function storeQuantity($type)
    {
        $this->validate([
            'quantity' => 'required|integer',
        ]);
        $old_quantity = $this->supply->quantity;
        SupplyQuantity::create([
            'supply_id' => $this->supply->id,
            'quantity' => $this->quantity,
            'old_quantity' => $old_quantity,
            'price' => $this->quantity * $this->supply->purchase_price,
            'type' => $type,
            'doctor_id' => $this->doctor_id,
            'clinic_id' => $this->clinic_id,
        ]);

        if ($type == 'in') {

            $this->supply->update([
                'quantity' => $this->quantity + $this->supply->quantity,
            ]);
        } else {

            $this->supply->update([
                'quantity' => $this->supply->quantity - $this->quantity,

            ]);
        }

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }
}

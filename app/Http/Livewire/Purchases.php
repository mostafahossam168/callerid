<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Livewire\WithPagination;
use App\Models\SupplyQuantity;

class Purchases extends Component
{
    public $name, $amount, $tax, $purchase, $tax_value;
    public $screen = 'index';
    public $type,
        $category_id,
        $category_child_id,
        $tax_number,
        $address,
        $phone,
        $qty,
        $supply_id,
        $date, $add_to_stock = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'type' => 'required|in:purchases,stocks',
            'category_id' => 'required',
            'category_child_id' => 'required',
            'name' => 'required',
            'amount' => 'required',
            'tax' => 'nullable',
            'tax_value' => 'nullable',
            'tax_number' => 'nullable',
            'address' => 'nullable',
            'phone' => 'nullable',
            'date' => 'nullable',
            'qty' => 'required',
            'supply_id' => $this->type == 'stocks' ? 'required' : 'nullable'
        ];
    }
    public function edit(Purchase $purchase)
    {
        $this->screen = 'edit';
        $this->type = $purchase->type;
        $this->address = $purchase->address;
        $this->category_id = $purchase->category_id;
        $this->category_child_id = $purchase->category_child_id;
        $this->phone = $purchase->phone;
        $this->qty = $purchase->qty;
        $this->tax_number = $purchase->tax_number;
        $this->name = $purchase->name;
        $this->amount = $purchase->amount;
        $this->tax = $purchase->tax;
        $this->tax_value = $purchase->tax_value;
        $this->supply_id = $purchase->supply_id;
        $this->purchase = $purchase;
    }
    public function save()
    {
        $data = $this->validate();
        if ($data['tax']) {
            $data['tax_value'] = $data['amount'] * (setting()->tax_rate / 100);
            $data['amount'] = $data['amount'] + $data['tax_value'];
        }
        if ($this->purchase) {
            $purchase = $this->purchase;
            $this->purchase->update($data);
        } else {
            $purchase = Purchase::create($data);
        }

        if ($this->add_to_stock) {
            $supply = $purchase->supply;
            $old_quantity = $supply->quantity;
            SupplyQuantity::create([
                'supply_id' => $supply->id,
                'quantity' => $purchase->qty,
                'old_quantity' => $old_quantity,
                'price' => $purchase->qty * $supply->purchase_price,
                'type' => 'in',
            ]);
            $supply->update([
                'quantity' => $purchase->qty + $supply->quantity,
            ]);
            $purchase->update(['date' => now()]);
        }

        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    public function delete(Purchase $purchase)
    {
        $purchase->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $purchases = Purchase::latest()->paginate(10);
        return view('livewire.purchases', compact('purchases'));
    }

    public function supply(Purchase $purchase)
    {
        $supply = $purchase->supply;
        $old_quantity = $supply->quantity;
        SupplyQuantity::create([
            'supply_id' => $supply->id,
            'quantity' => $purchase->qty,
            'old_quantity' => $old_quantity,
            'price' => $purchase->qty * $supply->purchase_price,
            'type' => 'in',
        ]);
        $supply->update([
            'quantity' => $purchase->qty + $supply->quantity,
        ]);
        $purchase->update(['date' => now()]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Supply delivered successfully')]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use App\Exports\ProductsExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class Products extends Component
{
    public $name, $department_id, $price, $product, $filter_by_department, $tax, $key, $discount_rate, $tax_enabled;
    // public $tax_type;
    use WithPagination;
    public $all_products = [];
    protected $paginationTheme = 'bootstrap';
    protected function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'department_id' => 'required',
            'discount_rate' => 'nullable|numeric',
            'tax_enabled' => 'nullable',
            // 'tax_type' => 'required',
        ];
    }

    public function edit(Product $product)
    {
        $this->name = $product->name;
        $this->price = $product->price;
        $this->department_id = $product->department_id;
        $this->tax_enabled = $product->tax_enabled;
        $this->product = $product;
    }

    public function save()
    {
        $data = $this->validate();


        $setting = Setting::first();


        $data['tax_enabled'] = $data['tax_enabled'] ? 1 : 0;
        if ($this->product) {
            $this->product->update($data);
        } else {
            Product::create($data);
        }
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    }
    //     public function save()
    // {
    //     $data = $this->validate([
    //         'name' => 'required|string|max:255',
    //         // 'description' => 'nullable|string',
    //         'amount' => 'required|numeric|min:0'
    //     ]);

    //     $data['price'] = $this->amount;
    //     $data['tax'] = 0;

    //     $setting = Setting::first();
    //     if ($setting->tax_enabled) {
    //         $tax = $this->amount * ($setting->tax_rate / 100);
    //         $data['tax'] = $tax;
    //         $data['price'] = $this->amount + $tax;
    //     }

    //     if ($this->product) {
    //         $this->product->update($data);
    //     } else {
    //         Product::create($data);
    //     }

    //     $this->reset();
    //     $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Saved successfully')]);
    // }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => __('Successfully deleted')]);
    }

    public function export()
    {
        return Excel::download(new ProductsExport($this->all_products), 'products' . time() . '.xlsx');
    }

    public function mount()
    {
        $this->all_products = Product::with('department')->where(function ($q) {
            if ($this->filter_by_department) {
                $q->where('department_id', $this->filter_by_department);
            }
        })->when($this->key, function ($q) {
            $q->where('name', 'LIKE', '%' . $this->key . '%');
        })->get();
    }
    public function render()
    {
        // $products = Product::with('department')->where(function ($q) {
        //     if ($this->filter_by_department) {
        //         $q->where('department_id', $this->filter_by_department);
        //     }
        // })->latest()->paginate(10);
        // $departments = Department::all();

        // return view('livewire.products', compact('products', 'departments'));

        $products = Product::with('department')->where(function ($q) {
            if ($this->filter_by_department) {
                $q->where('department_id', $this->filter_by_department);
            }
        })->when($this->key, function ($q) {
            $q->where('name', 'LIKE', '%' . $this->key . '%');
        })->latest()->paginate(10);
        $departments = Department::all();

        return view('livewire.products', compact('products', 'departments'));
    }
}

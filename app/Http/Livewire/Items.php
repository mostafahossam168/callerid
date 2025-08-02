<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\Setting;
use Livewire\Component;
use App\Models\Warehouse;
use App\Models\Department;
use App\Exports\ItemExport;
use App\Imports\ItemImport;
use App\Models\ItemCategory;
use App\Models\ItemQuantity;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Database\Eloquent\Builder;

class Items extends Component
{
    public $name, $quantity, $sale_price, $item, $allow_quantity = 1, $has_tax = true,
        $status, $less_stock, $barcode,
        $barcode_search, $key, $importFile, $importFileDeleteAll, $warehouse_id, $from_warehouse_id, $to_warehouse_id, $warehouse_data;

    public $open_quantity, $category_id, $filter_category_id, $image;
    public $selected_item,
        $barcode_selected_item;

    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'name' => 'required',
            'barcode' => 'required|unique:items,barcode,' . $this->item?->id,
            //'quantity' => ['nullable', 'required_if:allow_quantity,1', 'integer'],
            'sale_price' => 'required|numeric',
            'allow_quantity' => 'boolean',
            'has_tax' => 'boolean',
            'open_quantity' => 'nullable',
            'category_id' => 'required',
            'image' => 'nullable'
            //'tax_type' => 'required',

        ];
    }

    public function validationAttributes()
    {
        return [
            'barcode' => __('barcode'),
            'sale_price' => __('admin.selling_price'),
        ];
    }

    public function mount()
    {
        if (request('warehouse_id')) {
            $this->warehouse_id = request('warehouse_id');
            $this->updatedWarehouseId();
        }
    }

    public function updating()
    {
        $this->resetPage();
    }

    public function edit(Item $item)
    {
        $this->name = $item->name;
        $this->barcode = $item->barcode;
        //$this->quantity = $item->quantity;
        $this->sale_price = $item->sale_price;
        $this->allow_quantity = $item->allow_quantity;
        $this->has_tax = $item->has_tax;
        $this->category_id = $item->category_id;
        //$this->open_quantity = $item->open_quantity;
        //$this->tax_type = $item->tax_type;
        $this->item = $item;
        $this->image = $item->image;
    }

    public function save()
    {
        $data = $this->validate();
        $setting = Setting::first();
        $tax = $setting->tax_rate && $setting->tax_rate > 0 ? $this->sale_price * ($setting->tax_rate / 100) : 0;
        //dd($tax);
        // $data['tax'] = $tax;


        if ($this->item) {
            if ($this->image && $this->image !== $this->item->image) {
                $data['image'] = store_file($this->image, 'items');
            }
            $this->item->update($data);
        } else {
            $data['open_quantity'] = $this->quantity;
            if ($this->image) {
                $data['image'] = store_file($this->image, 'items');
            }

            $item = Item::create($data);
            ItemQuantity::create([
                'item_id' => $item->id,
                'quantity' => $this->quantity,
                'type' => 'charge',
            ]);
        }

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function delete(Item $item)
    {
        $item->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    public function render()
    {
        $items = Item::when($this->status, function ($q) {
            if ($this->status == 'available') {
                $q->where('quantity', '>', 0);
            } elseif ($this->status == 'less_stock') {
                $q->where('quantity', '<=', 5);
            } else {
                $q->where('quantity', '=', 0);
            }
        })->when($this->key, function ($q) {
            $q->where('name', 'LIKE', '%' . $this->key . '%');
        })->where(function ($query) {
            if ($this->barcode_search) {
                $query->where('barcode', $this->barcode_search);
            }
        })->when($this->warehouse_id, function ($q) {
            $q->whereHas('all_quantities', function ($q) {
                $q->where('warehouse_id', $this->warehouse_id);
            });
        })->when($this->filter_category_id, function (Builder $query) {
            if ($this->filter_category_id) {
                $query->where('category_id', $this->filter_category_id);
            }
        })
            ->latest()
            ->paginate(10);

        $all_warehouses = Warehouse::all();
        $categories = ItemCategory::get();
        return view('livewire.items', compact('items', 'all_warehouses', 'categories'));
    }

    public function updatedWarehouseId()
    {
        $this->warehouse_data = Warehouse::find($this->warehouse_id);
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'items_export_' . time() . '.xlsx');
    }

    public function import()
    {
        $this->validate([
            'importFile' => 'required|mimes:xlsx',
            'importFileDeleteAll' => 'nullable'
        ]);

        if ($this->importFileDeleteAll) {
            $this->deleteAll();
        }
        Excel::import(new ItemImport, $this->importFile);
        $this->reset(['importFile', 'importFileDeleteAll']);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Products Impotred Successfully')]);
    }

    public function deleteAll()
    {
        Item::whereNotNull('id')->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Products Deleted Successfully')]);
    }

    public function itemId(Item $item)
    {
        $this->item = $item;
    }

    public function charge()
    {
        $this->validate(['quantity' => 'required|gt:0', 'warehouse_id' => 'required']);

        ItemQuantity::create([
            'item_id' => $this->item->id,
            'quantity' => $this->quantity,
            'warehouse_id' => $this->warehouse_id,
            'type' => 'charge',
        ]);

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    public function expense()
    {
        $this->validate(['quantity' => 'required|gt:0', 'from_warehouse_id' => 'required', 'to_warehouse_id' => 'required|different:from_warehouse_id']);

        $warehouse_quantity = $this->item->quantities()->where('warehouse_id', $this->from_warehouse_id)->where('type', 'charge')->sum('quantity') - $this->item->quantities()->where('warehouse_id', $this->from_warehouse_id)->where('type', 'expense')->sum('quantity') - $this->item->order_items()->where('warehouse_id', $this->from_warehouse_id)->sum('quantity');

        if ($this->quantity > $warehouse_quantity) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'عفوا الكمية غير كافية']);
            return back();
        }

        ItemQuantity::create([
            'item_id' => $this->item->id,
            'quantity' => $this->quantity,
            'from_warehouse_id' => $this->from_warehouse_id,
            'to_warehouse_id' => $this->to_warehouse_id,
            'type' => 'expense',
        ]);

        ItemQuantity::create([
            'item_id' => $this->item->id,
            'quantity' => $this->quantity,
            'warehouse_id' => $this->to_warehouse_id,
            'type' => 'charge',
        ]);

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    }

    /* public function transfer()
    {
        $this->validate(['from_warehouse_id' => 'required', 'to_warehouse_id' => 'required|different:from_warehouse_id']);

        $this->item->quantities()->where('warehouse_id', $this->from_warehouse_id)
            ->update([
                'warehouse_id' => $this->to_warehouse_id
            ]);

        $this->reset();

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
    } */

    public function updatedSelectedItem()
    {
        $item = Item::find($this->selected_item);
        if ($item) {
            $this->barcode_selected_item = $item;
        }
    }
}

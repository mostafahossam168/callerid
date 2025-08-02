<?php

namespace App\Http\Livewire;

use App\Models\InvoiceItem;
use App\Models\PharmacyPrescription;
use App\Models\PharmacyQuantity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\PharmacyType;
use App\Models\PharmacyMedicine;
use App\Models\PharmacyDangerous;
use App\Models\PharmacyWarehouse;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Component
{
    use AuthorizesRequests;

    public $screen = 'statistics';

    public $model, $name;
    // warehouse
    public $parent_id, $is_show;
    public $item_id;
    //medicine
    public
        $scientific_name,
        $pharmacy_warehouse_id,
        $opening_balance,
        $pharmacy_type_id,
        $pharmacy_dangerous_id,
        $barcode,
        $purchasing_price,
        $selling_price,
        $expiry_date, $operational_number;
    public $obj;
    public $quantity, $from_warehouse_id, $to_warehouse_id;

    // prescription
    public $is_dispensed_by_pharmacist, $prescription_search_by_id, $prescription_search_by_name;
    public $queryString = ['screen'];
    /**
     * @var bool|mixed
     */
    public $filter;

    public function render()
    {

        $warehouses = PharmacyWarehouse::latest()->paginate(10);
        $parents = PharmacyWarehouse::whereNull('parent_id')->latest()->get();
        $types = PharmacyType::latest()->get();
        $dangers = PharmacyDangerous::latest()->get();
        $medicines = PharmacyMedicine::select(
            'pharmacy_medicines.*',
            DB::raw('SUM(CASE WHEN pharmacy_quantities.type = "charge" THEN pharmacy_quantities.quantity ELSE 0 END) - SUM(CASE WHEN pharmacy_quantities.type = "expense" THEN pharmacy_quantities.quantity ELSE 0 END) as total_quantity')
        )
            ->leftJoin('pharmacy_quantities', function ($join) {
                $join->on('pharmacy_medicines.id', '=', 'pharmacy_quantities.item_id')
                    ->where('pharmacy_quantities.item_type', '=', PharmacyMedicine::class);
            })
            ->groupBy('pharmacy_medicines.id')
            ->when($this->filter === 'expired', function ($query) {
                $query->where('expiry_date', '<', now()->toDateString());
            })
            ->when($this->filter === 'zero_quantity', function ($query) {
                $query->having('total_quantity', '=', 0);
            })
            ->get();


        $quantityZeroMedicines = PharmacyMedicine::get()->filter(function ($medicine) {
            $totalQuantity = $medicine->quantities()->charge()->sum('quantity') - $medicine->quantities()->expense()->sum('quantity');
            return $totalQuantity === 0;
        })->count();





        $prescriptions = PharmacyPrescription::where(function (Builder $query) {
            if ($this->is_dispensed_by_pharmacist) {
                if ($this->is_dispensed_by_pharmacist === 'active') {
                    $query->where('is_dispensed_by_pharmacist', 1);
                } else {
                    $query->where('is_dispensed_by_pharmacist', 0);
                }
            }
            if ($this->prescription_search_by_name) {
                $query->whereRelation('appointment.user', 'name', 'like', "%$this->prescription_search_by_name%")
                    ->orWhereRelation('appointment.user', 'phone', $this->prescription_search_by_name);
            }
            if ($this->prescription_search_by_id) {
                $query->where('id', $this->prescription_search_by_id);
            }
        })->latest()->paginate(10);
        return view('livewire.pharmacy.index', compact(
            'warehouses',
            'prescriptions',
            'parents',
            'types',
            'dangers',
            'medicines',
            'quantityZeroMedicines'
        ))
            ->extends('front.layouts.front')
            ->section('content');
    }

    public function updatedScreen()
    {
        $this->setModel();
    }

    public function setData($item_id)
    {
        if ($this->model === PharmacyMedicine::class) {
            $data = [
                'name',
                'scientific_name',
                'pharmacy_warehouse_id',
                'opening_balance',
                'pharmacy_type_id',
                'pharmacy_dangerous_id',
                'barcode',
                'purchasing_price',
                'selling_price',
                'expiry_date',
                'operational_number'
            ];
        } elseif ($this->model === PharmacyWarehouse::class) {
            $data = ['name', 'parent_id'];
        } else {
            $data = ['name'];
        }
        $this->item_id = $item_id;
        foreach ($data as $attr) {
            $model = $this->model::find($this->item_id);
            $this->$attr = $model->$attr;
        }
    }

    public function mount()
    {
        if (!setting()->pharmacy_status) {
            abort(404);
        }
        $this->setModel();
    }

    public function resetForm()
    {
        $this->resetExcept('screen', 'model');
    }

    public function show($item_id)
    {
        $this->setData($item_id);
        $this->is_show = 1;
    }

    public function save()
    {
        $rules = [];
        if ($this->model === PharmacyMedicine::class) {
            $rules = [
                'name' => 'required',
                'scientific_name' => 'required',
                'pharmacy_warehouse_id' => 'required',
                'opening_balance' => 'required',
                'pharmacy_type_id' => 'required',
                'pharmacy_dangerous_id' => 'required',
                'barcode' => 'required',
                'purchasing_price' => 'required',
                'selling_price' => 'required',
                'expiry_date' => 'nullable',
            ];
        } elseif ($this->model === PharmacyWarehouse::class) {
            $rules = ['name' => 'required', 'parent_id' => 'nullable'];
        } else {
            $rules = ['name' => 'required'];
        }
        $data = $this->validate($rules, [], [
            'scientific_name' => __('Scientific name'),
            "pharmacy_warehouse_id" => __('pharmacy_warehouse'),
            "opening_balance" => __('Opening balance'),
            "pharmacy_type_id" => __('admin.Type'),
            "pharmacy_dangerous_id" => __('pharmacy_dangerous'),
            "barcode" => __('Barcode'),
            "purchasing_price" => __('Purchasing price'),
        ]);
        if ($this->model === PharmacyMedicine::class) {
            $data['quantity'] = $this->opening_balance;
            $data['operational_number'] = PharmacyMedicine::max('operational_number') ? PharmacyMedicine::max('operational_number') + 1 : 5000;
        }


        if ($this->item_id) {
            $this->model::find($this->item_id)->update($data);
        } else {
            $this->model::create($data);
        }
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Saved successfully')]);
        $this->resetForm();
    }

    public function ItemId($id)
    {
        $this->obj = $this->model::find($id);
    }

    public function delete($id)
    {
        $item = $this->model::find($id);
        $item->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Successfully deleted')]);
    }

    // medicines
    public function dispense(PharmacyPrescription $prescription)
    {
        $prescription->update(['is_dispensed_by_pharmacist' => 1, 'pharmacist_id' => auth()->id()]);
        $prescription->invoice()->update(['status' => 'Unpaid']);
        foreach ($prescription->items as $item) {
            $item->pharmacyMedicine->update(['quantity' => $item->pharmacyMedicine->quantity - $item->quantity]);
        }

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الصرف بنجاح']);
    }

    public function charge()
    {
        $data = $this->validate(['pharmacy_warehouse_id' => 'required', 'quantity' => 'required|gt:0']);
        $data['item_type'] = get_class($this->obj);
        $data['item_id'] = $this->obj->id;
        $data['employee_id'] = auth()->id();
        $data['type'] = 'charge';
        $data['operational_number'] = PharmacyQuantity::max('operational_number') ? PharmacyQuantity::max('operational_number') + 1 : 5000;

        PharmacyQuantity::create($data);
        $this->resetExcept('screen', 'model');

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم شحن المنتج بنجاح']);
    }

    public function expense()
    {
        $data = $this->validate([
            'from_warehouse_id' => 'required',
            'to_warehouse_id' => 'required|different:from_warehouse_id',
            'quantity' => 'required|gt:0'
        ], [], [
            'from_warehouse_id' =>  __('admin.from_warehouse'),
            'to_warehouse_id' =>  __('admin.to_warehouse'),
        ]);

        $data['item_type'] = get_class($this->obj);
        $data['item_id'] = $this->obj->id;
        $data['employee_id'] = auth()->id();

        $warehouse_quantity = $this->obj->quantities()->where('pharmacy_warehouse_id', $this->from_warehouse_id)
            ->where('type', 'charge')->sum('quantity') -
            $this->obj->quantities()->where('from_warehouse_id', $this->from_warehouse_id)
            ->where('type', 'expense')->sum('quantity')
            - InvoiceItem::wherePharmacyMedicineId($this->obj->id)->sum('quantity');

        if ($warehouse_quantity < $this->quantity) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يوجد كمية كافية']);
            return;
        }

        $data['type'] = 'expense';
        $data['operational_number'] = PharmacyQuantity::max('operational_number') ?
            PharmacyQuantity::max('operational_number') + 1 : 5000;

        PharmacyQuantity::create($data);

        $data['type'] = 'charge';
        $data['operational_number'] = PharmacyQuantity::max('operational_number') ?
            PharmacyQuantity::max('operational_number') + 1 : 5000;

        unset($data['from_warehouse_id'], $data['to_warehouse_id']);
        $data['pharmacy_warehouse_id'] = $this->to_warehouse_id;
        PharmacyQuantity::create($data);

        $this->resetExcept('screen', 'model');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الصرف بنجاح']);
    }

    public function setModel()
    {
        if ($this->screen === 'warehouse') {
            $this->model = PharmacyWarehouse::class;
            $this->authorize('read_pharmacy_warehouse');
        } elseif ($this->screen === 'types') {
            $this->model = PharmacyType::class;
            $this->authorize('read_pharmacy_types');
        } elseif ($this->screen === 'dangerous') {
            $this->model = PharmacyDangerous::class;
            $this->authorize('read_pharmacy_dangerous');
        } elseif ($this->screen === 'describe') {
            $this->model = PharmacyPrescription::class;
            $this->authorize('read_pharmacy_descriptions');
        } else {
            $this->model = PharmacyMedicine::class;
            $this->authorize('read_pharmacy_medicine');
        }
    }
}

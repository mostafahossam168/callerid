<?php

namespace App\Http\Livewire\DoctorInvoice;

use App\Models\User;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;
use App\Models\Department;
use App\Models\LabCategory;
use App\Models\ScanService;

class EditInvoice extends Component
{

    public $invoice, $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount = 0, $total, $cash, $card, $rest, $discount = 0, $status, $tasdeed = false, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_id, $tax, $dr_id;
    protected function rules()
    {
        return [
            'patient' => 'required',
            'department_id' => 'required',
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'required',
            'card' => 'required',
            'rest' => 'required',
            'discount' => 'required',
            'notes' => 'nullable',
            'status' => 'required',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'offers_discount' => 'nullable',
            'items.*.quantity' => 'required|integer'
        ];
    }
    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    /*     public function add_product()
    {
    if($this->patient){
    if ($this->product_id ) {
    $product = Product::with('department')->findOrFail($this->product_id);
    $tax = 0;
    if (setting()->tax_enabled) {
    $tax = $product->price * (setting()->tax_rate / 100);
    }
    $discount=0;
    $offer=null;
    if($product->offer){
    $discount=$product->price * ($product->offer->rate / 100);
    $offer=$product->offer->id;
    }
    $total=$product->price-$discount+$tax;
    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $product->department->name, 'tax' => $tax,'offer_id'=>$offer];
    $this->computeForAll();
    $this->product_id = null;
    }
    }else{
    $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => __('Please select the patient first')]);
    }
    } */

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->where('id', $this->product_id)->first();
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
                if ($product and $product->department_id = $this->department_id) {
                    $tax = 0;
                    if (setting()->tax_enabled) {
                        $tax = $product->price * (setting()->tax_rate / 100);
                    }
                    $discount = 0;
                    $offer = null;
                    if ($product->offer) {
                        $discount = $product->price * ($product->offer->rate / 100);
                        $offer = $product->offer->id;
                    }
                    $total = $product->price - $discount + $tax;
                    $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => $tax, 'offer_id' => $offer];
                    $this->computeForAll();
                    $this->product_id = null;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                    $this->product_id = null;
                }
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        }
    }

    public function add_service()
    {
        if ($this->patient) {
            $serves = null;
            if ($this->lab_serv_id) {
                $serves = Service::with('category')->find($this->lab_serv_id);
            }
            if ($this->scan_serv_id) {
                $serves = ScanService::find($this->scan_serv_id);
            }
            if ($serves) {
                $tax = 0;
                if (setting()->tax_enabled) {
                    $tax = $serves->price * (setting()->tax_rate / 100);
                }
                $discount = 0;
                $offer = null;
                $total = $serves->price - $discount + $tax;
                $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $serves->id, 'product_name' => $serves->name, 'price' => $serves->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department' => $this->lab_serv_id ? 'lab' : 'scan', 'tax' => $tax];
                $this->computeForAll();
                $this->lab_serv_id = null;
                $this->scan_serv_id = null;
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
            $this->lab_serv_id = null;
            $this->scan_serv_id = null;
        }
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function computeForAll()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $price = $item['price'] ? $item['price'] * $item['quantity'] : 0;
            $carry += $price;
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        });
        $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['discount'];
            return $carry;
        });
        $this->total = $this->amount + $this->tax - $this->discount;
        $this->amount_after_offers_discount = $this->amount - $this->offers_discount;
        if ($this->split_number == "" or $this->split_number == 0) {
            $this->split_number = 1;
        }
        $this->total_after_split = $this->total / $this->split_number;
        /* $this->discount = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['discount'];
        return $carry;
        }); */

        /* $this->total = $this->amount + $this->tax - $this->discount; */
        $this->rest = $this->total;
        $this->calculateNet();
        if (count($this->items) == 0) {
            $this->amount = 0;
            $this->tax = 0;
            $this->total = 0;
        }
    }

    public function calculateNet()
    {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->discount = $this->discount == "" ? 0 : $this->discount;
        $this->rest
            = $this->total
            - ($this->card + $this->cash + $this->discount);
    }

    public function changeItemTotal($key)
    {
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] : 0;
        $this->items[$key]['price'] = $price;
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function submit()
    {
        $data = $this->validate();
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = auth()->id();
        /* $data['employee_id'] = auth()->id(); */
        $this->invoice->update($data);
        $this->invoice->products()->delete();
        $this->invoice->products()->createMany($this->items);
        if ($this->status == 'Paid') {
            foreach ($this->items as $item) {
                if ($item['is_lab']) {
                    $this->patient->labRequests()->create(['product_id' => $item['product_id'], 'doctor_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
                if ($item['is_scan']) {
                    $this->patient->scanRequests()->create(['product_id' => $item['product_id'], 'dr_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
                }
            }
        }
        if ($this->tasdeed) {
            return redirect()->route('doctor.pay_visit')->with('success', __('تم تسديد الفاتورة'));
        }
        return redirect()->route('doctor.invoices.index')->with('success', __('Saved successfully'));
    }

    public function mount()
    {

        if (request('tasdeed')) {
            $this->tasdeed = true;
        }
        $this->patient = $this->invoice->patient;
        $this->patient_key = $this->invoice->patient->id;
        $this->items = $this->invoice->products()->get()->toArray();
        $this->amount = $this->invoice->amount;
        $this->total = $this->invoice->total;
        $this->tax = $this->invoice->tax;
        $this->rest = $this->invoice->rest;
        $this->discount = $this->invoice->discount;
        $this->cash = $this->invoice->cash;
        $this->card = $this->invoice->card;
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->dr_id = $this->invoice->dr_id;
        $this->offers_discount = $this->invoice->offers_discount;
        $this->amount_after_offers_discount = $this->invoice->amount - $this->invoice->products()->sum('discount');
        $this->department_id = $this->invoice->department_id;
        $this->scan_services = ScanService::all();
    }


    public function render()
    {
        $departments = Department::get();
        $lab_categories = LabCategory::all();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->where('department_id', $this->department_id)->get();
        $products = Product::where('department_id', $this->department_id)->get();

        return view('livewire.doctor-invoice.edit-invoice', compact('departments', 'doctors', 'products'));
    }
}

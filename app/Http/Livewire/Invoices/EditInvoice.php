<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Vaccine;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;
use App\Models\Department;
use App\Models\LabCategory;
use App\Models\ScanService;
use App\Models\ItemCategory;

class EditInvoice extends Component
{
    public $invoice, $patient_key, $patient, $department_id, $items = [], $product_id, $notes, $invoice_id, $amount = 0, $total, $cash = 0, $card = 0, $rest, $discount = 0, $status, $tasdeed = false, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_id, $installment_company, $visa = 0, $mastercard = 0, $bank = 0, $tamara = 0, $tabby = 0;
    public $tax, $animal_id, $item_id, $products = [], $dr_id, $discount_rate, $discount_amount, $all_products = [], $product_name, $animals;
    public $entry_date,
        $departure_date;
    public $paid_tax, $paid_without_tax;
    public $category_id;
    public $is_has_vaccines, $vaccine_id, $vaccine_category_id, $vaccines = [], $next_vaccine_date;

    protected function rules()
    {
        return [
            'patient' => 'required',
            // 'animals' => 'required',
            'department_id' => 'required',
            'category_id' => 'nullable',
            'amount' => 'required',
            'total' => 'required',

            'cash' => 'nullable',
            'card' => 'nullable',
            'bank' => 'nullable',
            'visa' => 'nullable',
            'mastercard' => 'nullable',
            'tamara' => 'nullable',
            'tabby' => 'nullable',

            'rest' => 'nullable',
            'discount' => 'nullable',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'offers_discount' => 'nullable',
            'items.*.quantity' => 'required|integer',
            'products.*.quantity' => 'required|integer',

            'entry_date' => $this->department?->key == 'hotel_service' ? 'required' : 'nullable',
            'departure_date' => $this->department?->key == 'hotel_service' ? 'required' : 'nullable',
            'paid_tax' => 'nullable',
            'paid_without_tax' => 'nullable',
        ];
    }
    public $vaccine_animal_id;

    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)->orWhere('civil', $this->patient_key)->first();
        if ($this->patient) {
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
    }

    public function getDepartmentProperty()
    {
        return Department::find($this->department_id);
    }


    public function checkIfVaccineExists($vaccine_id, $animal_id, $next_vaccine_date)
    {
        $status = false;
        $vaccines = $this->vaccines;
        foreach ($vaccines as $key => $item) {
            if ($item['vaccine_id'] == $vaccine_id && $item['animal_id'] == $animal_id && $item['next_vaccine_date'] == $next_vaccine_date) {
                $vaccines[$key]['quantity'] = $item['quantity'] + 1;
                $price = $vaccines[$key]['price'] * $vaccines[$key]['quantity'];
                if (setting()->tax_enabled) {
                    $tax = $price * (setting()->tax_rate / 100);
                } else {
                    $tax = 0;
                }
                $vaccines[$key]['tax'] = $tax;
                $vaccines[$key]['sub_total'] = $price + $tax;
                $status = true;
            }
        }
        $this->vaccines = $vaccines;
        return $status;
    }


    public function add_vaccine()
    {
        if ($this->vaccine_id) {
            $vaccine = Vaccine::find($this->vaccine_id);
            if ($vaccine) {
                $discount = 0;
                $tax = 0;
                $price = $vaccine->price;
                if ($vaccine->tax_enabled && setting()->tax_enabled) {
                    $tax = setting()->tax_rate / 100 * $price;
                }
                if ($vaccine->discount_rate) {
                    $discount = $price * $vaccine->discount_rate / 100;
                }
                $total = ($price + $tax) - $discount;
                if (!$this->checkIfVaccineExists($vaccine->id, $this->vaccine_animal_id, $this->next_vaccine_date)) {
                    $this->vaccines[] = [
                        'invoice_id' => $this->invoice_id,
                        'vaccine_id' => $vaccine->id,
                        'product_name' => $vaccine->name,
                        'amount' => round($price, 2),
                        'price' => round($price, 2),
                        'discount' => $discount,
                        'quantity' => 1,
                        'sub_total' => $total,
                        'tax' => round($tax, 2),
                        'department' => $vaccine->category?->name,
                        'next_vaccine_date' => $this->next_vaccine_date,
                        'category_id' => $this->vaccine_category_id,
                        'animal_id' => $this->vaccine_animal_id
                    ];
                }

                $this->computeForAll();
                $this->reset('vaccine_category_id', 'vaccine_animal_id', 'next_vaccine_date', 'vaccine_id');
            }
        }
    }

    public function delete_vaccine($key)
    {
        unset($this->vaccines[$key]);
    }

    public function changeQtyAndComputeVaccines($key)
    {
        $price = $this->vaccines[$key]['price'] * (int)$this->vaccines[$key]['quantity'];
        if (setting()->tax_enabled) {
            $tax = $price * (setting()->tax_rate / 100);
        } else {
            $tax = 0;
        }
        $this->vaccines[$key]['tax'] = $tax;
        $this->vaccines[$key]['sub_total'] = $price + $tax;
        $this->computeForAll();
    }

    public function add_product()
    {
        if ($this->patient) {
            $product = null;
            if ($this->product_id) {
                $product = Product::with('department')->where('id', $this->product_id)->first();
                $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
                if ($product and $product->department_id = $this->department_id) {
                    $quantity = Carbon::parse($this->departure_date)->diffInDays($this->entry_date) ?: 1;
                    $discount = 0;
                    $offer = null;
                    $price = $product->price;
                    if (setting()->tax_enabled && $product->tax_enabled) {
                        $tax = ($price * $quantity) * (setting()->tax_rate / 100);
                    } else {
                        $tax = 0;
                        $price = $product->price;
                    }
                    if ($product->offer) {
                        $discount = $price * ($product->offer->rate / 100);
                        $offer = $product->offer->id;
                    }
                    $total = ($price + $tax) - $discount;
                    // dd($this->checkIfItemExists($product->id));
                    // dd($this->checkIfItemExists($product->id), $product->id, $this->items);
                    if (!$this->checkIfItemExists($product->id)) {
                        $this->items[] = [
                            'invoice_id' => $this->invoice_id,
                            'product_id' => $product->id, 'product_name' => $product->name, 'tax_type' => $product->tax_type, 'tax_type_ar' => $product->taxTypeAr, 'amount' => round($price, 2), 'price' => round($price, 2), 'discount' => $discount, 'quantity' => 1, 'sub_total' => round($total, 2), 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => round($tax, 2), 'offer_id' => $offer
                        ];
                    }
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


    public function getProduct($value)
    {
        if ($value) {
            if ($this->department_id) {

                $products = Product::where('name', 'LIKE', '%' . $value . '%')->where('department_id', $this->department_id)->get();
                if ($products->count() > 0) {
                    $this->all_products = $products;
                    $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم جلب الخدمات بنجاح']);
                } else {
                    $this->all_products = [];
                    $this->product_id = '';
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يوجد خدمات بهذا الاسم']);
                }
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد القسم أولا']);
            }
        } else {
            $this->all_products = [];
            $this->product_id = '';
        }
    }

    public function chooseProduct($value)
    {
        if ($value) {
            $this->product_id = $value;
            $this->add_product();
            $this->all_products = [];
            $this->product_name = '';
        } else {
            $this->product_id = '';
            $this->all_products = [];
            $this->product_name = '';
        }
    }

    public function add_item()
    {
        if ($this->patient) {
            $item = null;
            if ($this->item_id) {
                // $item = Item::find($this->item_id);
                $item = Item::where('barcode', $this->item_id)->orWhere('id', $this->item_id)->first();
                // $this->department_id = $item->department_id;
                $department = Department::find($this->department_id);
                if ($item) {
                    if ($item->allow_quantity && $item->quantity > 0) {
                        $tax = $item->tax ? $item->tax : 0;
                        /* if (setting()->tax_enabled && $item->has_tax) {
                        $tax = $item->sale_price * (setting()->tax_rate / 100);
                        } */
                        $discount = 0;
                        $offer = null;

                        $total = $item->sale_price - $discount + $tax;
                        if (!$this->checkIfItemExists($item->id, 'item_id', 'products')) {
                            // dd($item, $department);
                            if (!$department) {
                                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('برجاء اختيار القسم')]);
                            } else {
                                $this->products[] = [
                                    'invoice_id' => $this->invoice_id,
                                    'item_id' => $item->id,
                                    'product_name' => $item->name,
                                    'price' => $item->sale_price,
                                    'discount' => $discount, 'quantity' => 1,
                                    'sub_total' => $total,
                                    'department_id' => $this->department_id,
                                    'category_id' => $this->category_id,
                                    'department' => $department->name,
                                    'tax_type' => $item->tax_type,
                                    'tax_type_ar' => $item->taxTypeAr,
                                    'tax' => $tax,
                                    'amount' => $item->sale_price,
                                    'offer_id' => $offer
                                ];
                            }
                        }
                        $this->computeForAll();
                        $this->item_id = null;
                    } else {
                        $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('الكمية غير متوفرة')]);
                        $this->item_id = null;
                    }
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم المنتج المدخل لا يتوفر في هذا القسم')]);
                    $this->item_id = null;
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

    public function delete_product($key)
    {
        unset($this->products[$key]);
        $this->computeForAll();
    }

    public function computeForAll()
    {
        // dd($this->items) ;
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $quantity = $item['quantity'] ? $item['quantity'] : 1;
            $price = $item['price'] ? $item['price'] * $quantity : 0;
            $carry += round($price, 2);
            return $carry;
        }) + array_reduce($this->products, function ($carry, $item) {
            $quantity = $item['quantity'] ? $item['quantity'] : 1;
            $price = $item['price'] ? $item['price'] * $quantity : 0;
            $carry += round($price, 2);
            return $carry;
        }) + array_reduce($this->vaccines, function ($carry, $item) {
            $quantity = $item['quantity'] ? $item['quantity'] : 1;
            $price = $item['price'] ? $item['price'] * $quantity : 0;
            $carry += round($price, 2);
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        }) + array_reduce($this->products, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        }) + array_reduce($this->vaccines, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        });

        $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['discount'];
            return $carry;
        });

        // Getting total quantities t0 multi
        $my_quantity = 0;
        foreach ($this->items as $item) {
            $my_quantity += $item["quantity"];
        }

        $products_quantity = 0;
        foreach ($this->products as $item) {
            $products_quantity += $item["quantity"];
        }

        if ($this->discount_rate) {
            $this->discount = round(($this->amount + $this->tax) * $this->discount_rate / 100, 2);
        }

        if ($this->discount_amount) {
            $this->discount = $this->discount_amount;
        }

        // old calculation
        $this->total = round($this->amount + ($this->tax) - $this->discount - $this->offers_discount, 2);
        // new calculation
        //$this->total = $this->amount + $this->tax - $this->discount - $this->offers_discount;

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
        //$this->rest = $this->total;
        $this->cash = $this->total;
        $this->calculateNet();
    }

    public function calculateNet()
    {
        if ($this->discount_rate > 0) {
            $this->discount = ($this->amount + $this->tax) * $this->discount_rate / 100;
            $this->amount_after_offers_discount = $this->amount - $this->discount;
            if (setting()->tax_enabled) {
                $this->tax = $this->amount_after_offers_discount * (setting()->tax_rate / 100);
            }
            $this->total = round($this->amount_after_offers_discount + $this->tax, 2);
            $this->cash = $this->total;
        } elseif ($this->discount_amount > 0) {
            $this->discount = $this->discount_amount;
            $this->amount_after_offers_discount = round($this->amount - $this->discount, 2);
            if (setting()->tax_enabled) {
                $this->tax = round($this->amount_after_offers_discount * (setting()->tax_rate / 100), 2);
            }
            $this->total = round($this->amount_after_offers_discount + $this->tax, 2);
            $this->cash = $this->total;
        } else {
            $this->amount_after_offers_discount = $this->amount;
            if (setting()->tax_enabled) {
                $this->tax = round($this->amount_after_offers_discount * (setting()->tax_rate / 100), 2);
            }
            $this->total = $this->amount_after_offers_discount + $this->tax;
            $this->cash = $this->total;
        }
        $this->calculateMethods();
    }

    protected function calculateMethods()
    {
        $total = ((float)$this->card) + ((float)$this->cash) + ((float)$this->mastercard) + ((float)$this->bank) + ((float)$this->visa);
        if ($total > $this->total) {
            $this->reset(['card', 'cash', 'mastercard', 'bank', 'visa', 'paid_tax', 'paid_without_tax']);
            $this->rest = $this->total;
        } else {
            $amount = $this->amount_after_offers_discount;
            $tax = 0;
            $paidTax = 0;
            $paidTotal = $amount + $tax;
            if (setting()->tax_enabled and $this->patient->country_id != 1) {
                $tax = ($amount) * (setting()->tax_rate / 100);
                $paidTotal = $total > 0 ? ($total * 100) / (100 + setting()->tax_rate) : 0;
                $paidTax = round($total - $paidTotal, 2);
            }

            $this->rest = round(((float)$this->total) - (float)$total, 2);
            $this->tax = round($tax, 2);
            $this->total = round($amount + $tax, 2);
            $this->paid_tax = round($paidTax, 2);
            $this->paid_without_tax = round($paidTotal, 2);
        }
    }

    public function updatedCash()
    {
        $this->calculateMethods();
    }

    public function updatedCard()
    {
        $this->calculateMethods();
    }

    public function updatedVisa()
    {
        $this->calculateMethods();
    }

    public function updatedBank()
    {
        $this->calculateMethods();
    }

    public function updatedMastercard()
    {
        $this->calculateMethods();
    }

    public function updatedDiscount()
    {
        if ($this->discount > $this->total) {
            $this->discount = 0;
        }
        $this->computeForAll();
        $this->calculateMethods();
    }

    public function manualCalculate()
    {
        $this->calculateMethods();
    }


    public function changeItemTotal($key)
    {
        if ($this->items[$key]['quantity'] == 0) {
            $items = $this->items;
            unset($items[$key]);
            $this->items = $items;
        } else {
            $price = $this->items[$key]['price'] ? $this->items[$key]['price'] * $this->items[$key]['quantity'] : 0;
            $this->items[$key]['price'] = $price;
            $product = Product::find($this->items[$key]['product_id']);
            if (setting()->tax_enabled && $product->tax_enabled) {
                $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
            }
            // $this->items[$key]['tax'] = $this->items[$key]['tax'];
            $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        }

        $this->computeForAll();
        //dd($this->items[$key]);
    }

    public function submit()
    {
        $data = $this->validate();
        unset($data['animals']);
        // dd($data);
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = auth()->id();
        /* $data['employee_id'] = auth()->id(); */
        if ($this->department->key != 'hotel_service') {
            $this->reset('entry_date', 'departure_date');
        }


        if ($this->status == 'tmara') {
            $data['installment_company'] = 1;
            $data['status'] = 'Paid';
            $installment_company_tax = $this->total * (setting()->installment_company_tax / 100);
            $data['installment_company_tax'] = $installment_company_tax;
            if ($this->total > 2500) {
                $installment_company_amount_tax = $this->total * (setting()->installment_company_max_amount_tax / 100);
                $data['installment_company_max_amount_tax'] = $installment_company_amount_tax;
                $data['installment_company_min_amount_tax'] = 0;
            } else {
                $installment_company_amount_tax = $this->total * (setting()->installment_company_min_amount_tax / 100);
                $data['installment_company_max_amount_tax'] = 0;
                $data['installment_company_min_amount_tax'] = $installment_company_amount_tax;
            }
            $data['installment_company_rest'] = $this->total - $installment_company_tax - $installment_company_amount_tax;
            $data['tax'] = 0;
        }
        // dd($this->products);
        $data['cash'] = isset($data['cash']) ? $data['cash'] : 0;
        $data['bank'] = isset($data['bank']) ? $data['bank'] : 0;
        $data['visa'] = isset($data['visa']) ? $data['visa'] : 0;
        $data['card'] = isset($data['card']) ? $data['card'] : 0;

        $this->invoice->update($data);
        $this->invoice->products()->delete();
        $this->invoice->products()->createMany($this->items);
        $this->invoice->items()->createMany($this->products);
        $this->invoice->animals()->sync($this->animals);
        /*  if ($this->status == 'Paid') {
        foreach ($this->items as $item) {
        if ($item['is_lab']) {
        $this->patient->labRequests()->create(['product_id' => $item['product_id'], 'doctor_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
        }
        if ($item['is_scan']) {
        $this->patient->scanRequests()->create(['product_id' => $item['product_id'], 'dr_id' => auth()->id(), 'clinic_id' => $item['department_id']]);
        }
        }
        } */
        if ($this->tasdeed) {
            return redirect()->route('front.pay_visit')->with('success', __('تم تسديد الفاتورة'));
        }
        return redirect()->route('front.invoices.index')->with('success', __('Saved successfully'));
    }

    // public function mount()
    // {

    //     if (request('tasdeed')) {
    //         $this->tasdeed = true;
    //     }
    //     $this->patient = $this->invoice->patient;
    //     $this->patient_key = $this->invoice->patient->id;
    //     $this->items = $this->invoice->invoice_products()->get()->toArray();
    //     $this->products = $this->invoice->item_products()->get()->toArray();
    //     $this->amount = $this->invoice->amount;
    //     $this->total = $this->invoice->total;
    //     $this->tax = $this->invoice->tax;
    //     $this->rest = $this->invoice->rest;
    //     $this->discount_amount = $this->invoice->discount;
    //     $this->discount = $this->invoice->discount;
    //     $this->cash = $this->invoice->cash;
    //     $this->card = $this->invoice->card;
    //     $this->status = $this->invoice->status;
    //     $this->notes = $this->invoice->notes;
    //     $this->dr_id = $this->invoice->dr_id;
    //     $this->animal_id = $this->invoice->animal_id;
    //     $this->offers_discount = $this->invoice->offers_discount;
    //     $this->amount_after_offers_discount = $this->invoice->amount - $this->invoice->products()->sum('discount');
    //     $this->department_id = $this->invoice->department_id;
    //     $this->scan_services = ScanService::all();
    //     $this->animals = $this->invoice->animals()->pluck('id')->toArray();


    //     $this->computeForAll();
    // }

    public function mount()
    {

        if (auth()->user()->type == 'dr') {
            abort(403);
        }
        if (request('tasdeed')) {
            $this->tasdeed = true;
        }
        $this->patient = $this->invoice->patient;
        $this->patient_key = $this->invoice->patient?->id;
        $this->items = $this->invoice->products()->get()->toArray();
        $this->amount = $this->invoice->amount;
        $this->total = $this->invoice->total;
        $this->tax = $this->invoice->tax;
        $this->rest = $this->invoice->rest;
        $this->discount = $this->invoice->discount;
        $this->discount_amount = $this->invoice->discount;
        $this->cash = $this->invoice->cash;
        $this->bank = $this->invoice->bank;
        $this->tamara = $this->invoice->tamara;
        $this->tabby = $this->invoice->tabby;
        $this->visa = $this->invoice->visa;
        $this->mastercard = $this->invoice->mastercard;
        $this->card = $this->invoice->card;
        $this->entry_date = $this->invoice->entry_date;
        $this->departure_date = $this->invoice->departure_date;
        // if ($this->invoice->status == 'Unpaid') {
        //     $this->cash = $this->invoice->total;
        //     $this->rest = 0;
        // }
        $this->paid_tax = $this->invoice->paid_tax;
        $this->paid_without_tax = $this->invoice->paid_without_tax;
        $this->status = $this->invoice->status;
        $this->notes = $this->invoice->notes;
        $this->installment_company = $this->invoice->installment_company;
        $this->dr_id = $this->invoice->dr_id;
        $this->offers_discount = $this->invoice->offers_discount;
        $this->amount_after_offers_discount = $this->invoice->amount - $this->invoice->discount;
        $this->department_id = $this->invoice->department_id;
        $this->category_id = $this->invoice->category_id;
        $this->scan_services = ScanService::all();
        $this->animal_id = $this->invoice->animal_id;
        $this->animals = $this->invoice->animals()->pluck('id')->toArray();
        // $this->animals = $this->tasdeed ? [$this->invoice->animal_id] : $this->invoice->animals()->pluck('id')->toArray();
    }

    public function render()
    {
        $departments = Department::get();
        $categories = ItemCategory::get();
        $lab_categories = LabCategory::all();
        $lab_services = Service::where('category_id', $this->lab_cat_id)->get();
        $doctors = User::doctors()->whereHas('departments', function ($query) {
            $query->where('departments.id', $this->department_id);
        })->get();
        /* $all_products = Product::where('department_id', $this->department_id)->get(); */
        $all_items = Item::where('category_id', $this->category_id)->get();

        return view('livewire.invoices.edit-invoice', compact('doctors', 'categories', 'departments', 'lab_categories', 'lab_services', /* 'all_products', */ 'all_items'));
    }

    public function checkIfItemExists($product, $col = 'product_id', $type = 'items')
    {
        $status = false;
        $items = $this->{$type};
        foreach ($items as $key => $item) {
            if ($item[$col] == $product) {
                $items[$key]['quantity'] = $item['quantity'] + 1;
                $status = true;
            }
        }
        $this->{$type} = $items;
        return $status;
    }
}

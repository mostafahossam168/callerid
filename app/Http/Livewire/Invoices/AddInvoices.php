<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Category;
use App\Models\Vaccine;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;
use App\Models\PointLog;
use App\Models\Department;
use App\Models\PointOffer;
use App\Models\UserAnimal;
use App\Models\LabCategory;
use App\Models\ScanService;
use App\Models\ItemCategory;

class AddInvoices extends Component
{
    public $patient_key, $patient, $department_id, $items = [], $animals = [], $product_id, $notes, $invoice_id, $amount, $total, $cash = 0, $card = 0, $rest = 0, $discount = 0, $status, $dr_id, $tax, $offers_discount, $amount_after_offers_discount, $split, $split_number, $total_after_split, $lab_cat_id, $lab_serv_id, $scan_services, $scan_serv_id, $points, $installment_company, $visa = 0, $mastercard = 0, $bank = 0, $tamara = 0, $tabby = 0;
    public $patient_phone;
    public $animal_id, $item_id, $products = [], $discount_rate, $discount_amount, $all_products = [], $product_name;
    public $departure_date, $entry_date;
    public $paid_tax, $paid_without_tax;
    public $category_id, $item_id_qr;

    public $all_items = [], $is_has_vaccines, $vaccine_id, $vaccine_category_id, $vaccines = [];

    public $item_name;
    public $next_vaccine_date;
    public $vaccine_animal_id;

    protected function rules()
    {
        return [
            'patient' => 'nullable',
            // 'animal_id' => 'required',
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
            'discount' => 'required',
            'notes' => 'nullable',
            'installment_company' => 'nullable',
            'status' => 'required_without:installment_company',
            'dr_id' => 'nullable',
            'tax' => 'nullable',
            'offers_discount' => 'nullable',
            'items.*.quantity' => 'required|integer',
            'vaccines.*.quantity' => 'required|integer',
           /* 'vaccines.*.next_vaccine_date' => 'required|date',*/
            'products.*.quantity' => 'required|integer',
            'animals.*' => 'required',

            'entry_date' => $this->department?->key == 'hotel_service' ? 'required' : 'nullable',
            'departure_date' => $this->department?->key == 'hotel_service' ? 'required' : 'nullable',
            'paid_tax' => 'nullable',
            'paid_without_tax' => 'nullable',
        ];
    }

    public function getDepartmentProperty()
    {
        return Department::find($this->department_id);
    }

    public function get_patient()
    {
        $this->patient = Patient::where('id', $this->patient_key)
            ->orWhere('civil', $this->patient_key)
            ->orWhere('phone', $this->patient_key)
            ->orWhere('first_name', $this->patient_key)
            ->first();
        if ($this->patient) {
            // dd($this->patient);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Patient data has been retrieved successfully')]);
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
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
                if (!$this->checkIfVaccineExists($vaccine->id, $this->vaccine_animal_id,$this->next_vaccine_date)) {
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
                $this->reset('vaccine_category_id','vaccine_animal_id','next_vaccine_date','vaccine_id');

            }
        }
    }

    public function delete_vaccine($key)
    {
        unset($this->vaccines[$key]);
    }

    public function changeQtyAndComputeItems($key)
    {
        $price = $this->items[$key]['price'] * (int)$this->items[$key]['quantity'];
        if (setting()->tax_enabled) {
            $tax = $price * (setting()->tax_rate / 100);
        } else {
            $tax = 0;
        }
        $this->items[$key]['tax'] = $tax;
        $this->items[$key]['sub_total'] = $price + $tax;
        $this->computeForAll();
    }

    public function changeQtyAndComputeProducts($key)
    {
        $price = $this->products[$key]['price'] * (int)$this->products[$key]['quantity'];
        if (setting()->tax_enabled) {
            $tax = $price * (setting()->tax_rate / 100);
        } else {
            $tax = 0;
        }
        $this->products[$key]['tax'] = $tax;
        $this->products[$key]['sub_total'] = $price + $tax;
        $this->computeForAll();
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
        //        if ($this->patient) {
        $product = null;
        if ($this->product_id) {
            $product = Product::with('department')->where('id', $this->product_id)->first();
            $this->department_id = $this->department_id ? $this->department_id : $product->department_id;
            if ($product && $product->department_id == $this->department_id) {
                // $tax = $product->tax ?? 0;

                $discount = 0;
                $offer = null;
                if ($product->offer) {
                    $discount = $product->price * ($product->offer->rate / 100);
                    $offer = $product->offer->id;
                }

                // dd($this->checkIfItemExists($product->id));
                // dd($this->checkIfItemExists($product->id), $product->id, $this->items);
                if (!$this->checkIfItemExists($product->id)) {
                    $quantity = Carbon::parse($this->departure_date)->diffInDays($this->entry_date) ?: 1;
                    $price = $product->price;
                    if (setting()->tax_enabled && $product->tax_enabled) {
//                        dd($price);
                        $tax = ($price * $quantity) * (setting()->tax_rate / 100);
                    } else {
                        $tax = 0;
                    }
                    $total = (($price * $quantity) + $tax) - $discount;

                    $this->items[] = [
                        'invoice_id' => $this->invoice_id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'tax_type' => $product->tax_type,
                        'tax_type_ar' => $product->taxTypeAr,
                        'amount' => round($price, 2),
                        'price' => round($price, 2),
                        'discount' => $discount,
                        'quantity' => $quantity,
                        'sub_total' => $total,
                        'department_id' => $product->department->id,
                        'department' => $product->department->name,
                        'is_lab' => $product->department->is_lab,
                        'is_scan' => $product->department->is_scan,
                        'tax' => round($tax, 2),
                        'offer_id' => $offer
                    ];
                }
                $this->computeForAll();
                $this->product_id = null;
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                $this->product_id = null;
            }
        }
        //        }else {
        //            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        //        }
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

    public function getItem($value)
    {
        if ($value) {
            if ($this->category_id) {

                $products = Item::where('name', 'LIKE', '%' . $value . '%')->where('category_id', $this->category_id)->get();
                if ($products->count() > 0) {
                    $this->all_items = $products;
                    $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم جلب المنتجات بنجاح']);
                } else {
                    $this->all_items = [];
                    $this->item_id = '';
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يوجد منتجات بهذا الاسم']);
                }
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يجب تحديد القسم أولا']);
            }
        } else {
            $this->all_items = [];
            $this->item_id = '';
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

    public function chooseItem($value)
    {
        if ($value) {
            $this->item_id = $value;
            $this->add_item();
            $this->all_items = [];
            $this->item_name = '';
        } else {
            $this->item_id = '';
            $this->all_items = [];
            $this->item_name = '';
        }
    }


    public function add_item()
    {
        if ($this->patient) {
            $item = null;
            if ($this->item_id) {
                // $item = Item::find($this->item_id);
                $item = Item::where('id', $this->item_id)->first();

                // $this->department_id = $item->department_id;
                $category = Category::find($this->category_id);
                $department = Department::find($this->department_id);
                if ($item) {
                    if ($item->allow_quantity && $item->quantity > 0) {
                        // $tax = $item->tax ?? 0;
                        if (setting()->tax_enabled && $item->has_tax) {
                            $tax = $item->sale_price * (setting()->tax_rate / 100);
                        } else {
                            $tax = 0;
                        }
                        $discount = 0;
                        $offer = null;

                        $total = ($item->sale_price + $tax) - $discount;
                        if (!$this->checkIfItemExists($item->id, 'item_id', 'products')) {
                            // dd($item, $category);
                            if (!$category) {
                                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('برجاء اختيار القسم')]);
                            } else {
                                $this->products[] = [
                                    'invoice_id' => $this->invoice_id,
                                    'item_id' => $item->id,
                                    'product_name' => $item->name,
                                    'price' => $item->sale_price,
                                    'discount' => $discount,
                                    'quantity' => 1,
                                    'sub_total' => $total,
                                    'department_id' => $this->department_id,
                                    'category_id' => $this->category_id,
                                    'department' => $department?->name,
                                    'tax_type' => $item->tax_type,
                                    'tax_type_ar' => $item->taxTypeAr,
                                    'tax' => $tax,
                                    'amount' => $item->price,
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

    public function add_item_barcode()
    {
        //        if ($this->patient) {
        $item = null;
        if ($this->item_id) {
            // $item = Item::find($this->item_id);
            $item = Item::where('barcode', $this->item_id)->first();

            // $this->department_id = $item->department_id;
            $department = ItemCategory::find($this->category_id);
            if ($item) {
                if ($item->quantity > 0) {
                    $tax = $item->tax ?? 0;
                    /* if (setting()->tax_enabled && $item->has_tax) {
                        $tax = $item->sale_price * (setting()->tax_rate / 100);
                        } */
                    $discount = 0;
                    $offer = null;

                    $total = $item->sale_price - $discount + $tax;
                    if (!$this->checkIfItemExists($item->id, 'item_id', 'products')) {
                        // dd($item, $department);
                        if (!$department) {
                            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('برجاء اختيار العيادة')]);
                        } else {
                            $this->products[] = ['invoice_id' => $this->invoice_id, 'item_id' => $item->id, 'product_name' => $item->name, 'price' => $item->sale_price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $this->department_id, 'category_id' => $this->category_id, 'department' => $department->name, 'tax_type' => $item->tax_type, 'tax_type_ar' => $item->taxTypeAr, 'tax' => $tax, 'amount' => $item->price, 'offer_id' => $offer];
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
        //        } else {
        //            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
        //        }
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
                $carry += $price;
                return round($carry, 2);
            }) + array_reduce($this->products, function ($carry, $item) {
                $quantity = $item['quantity'] ? $item['quantity'] : 1;
                $price = $item['price'] ? $item['price'] * $quantity : 0;
                $carry += $price;
                return round($carry, 2);
            })
            + array_reduce($this->vaccines, function ($carry, $item) {
                $quantity = $item['quantity'] ? $item['quantity'] : 1;
                $price = $item['price'] ? $item['price'] * $quantity : 0;
                $carry += $price;
                return round($carry, 2);
            });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
                $carry += $item['tax'];
                return round($carry, 2);
            }) + array_reduce($this->products, function ($carry, $item) {
                $carry += $item['tax'];
                return round($carry, 2);
            })
            + array_reduce($this->vaccines, function ($carry, $item) {
                $carry += $item['tax'];
                return round($carry, 2);
            });

        $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['discount'];
            return round($carry, 2);
        });

        // Getting total quantities t0 multi
        $my_quantity = 0;
        foreach ($this->items as $item) {
            $my_quantity += (int)$item["quantity"];
        }

        $products_quantity = 0;
        foreach ($this->products as $item) {
            $products_quantity += (int)$item["quantity"];
        }

        if ($this->discount_rate) {
            $this->discount = round(($this->amount + $this->tax) * $this->discount_rate / 100, 2);
        }

        if ($this->discount_amount) {
            $this->discount = $this->discount_amount;
        }

        // old calculation
        // $this->total = $this->amount + ($this->tax) - $this->discount - $this->offers_discount;
        // new calculation
        $this->total = round($this->amount + $this->tax - $this->discount - $this->offers_discount, 2);

        $this->amount_after_offers_discount = round($this->amount - $this->offers_discount - $this->discount, 2);
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
        $this->cash = round($this->total, 2);
        //$this->calculateNet();
    }

    public function calculateNet()
    {
        if ($this->discount_rate > 0) {
            $this->discount = ($this->amount + $this->tax) * $this->discount_rate / 100;
            $this->amount_after_offers_discount = $this->amount - $this->discount;
            if (setting()->tax_enabled) {
                $this->tax = round($this->amount_after_offers_discount * (setting()->tax_rate / 100), 2);
            }
            $this->total = round($this->amount_after_offers_discount + $this->tax, 2);
            $this->cash = round($this->total, 2);
        } elseif ($this->discount_amount > 0) {
            $this->discount = $this->discount_amount;
            $this->amount_after_offers_discount = round($this->amount - $this->discount, 2);
            if (setting()->tax_enabled) {
                $this->tax = round($this->amount_after_offers_discount * (setting()->tax_rate / 100), 2);
            }
            $this->total = round($this->amount_after_offers_discount + $this->tax, 2);
            $this->cash = round($this->total, 2);
        } else {
            $this->amount_after_offers_discount = $this->amount;
            if (setting()->tax_enabled) {
                $this->tax = round($this->amount_after_offers_discount * (setting()->tax_rate / 100), 2);
            }
            $this->total = round($this->amount_after_offers_discount + $this->tax, 2);
            $this->cash = round($this->total, 2);
        }
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
            if (setting()->tax_enabled) {
                $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
            }
            // $this->items[$key]['tax'] = $this->items[$key]['tax'];
            $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        }

        $this->computeForAll();
        //dd($this->items[$key]);
    }

    public function changeVaccineTotal($key)
    {
        if ($this->vaccines[$key]['quantity'] == 0) {
            $vaccines = $this->vaccines;
            unset($vaccines[$key]);
            $this->vaccines = $vaccines;
        } else {
            $price = $this->vaccines[$key]['price'] ? $this->vaccines[$key]['price'] * $this->vaccines[$key]['quantity'] : 0;
            $this->vaccines[$key]['price'] = $price;
            if (setting()->tax_enabled) {
                $this->vaccines[$key]['tax'] = $price * (setting()->tax_rate / 100);
            }
            $this->vaccines[$key]['sub_total'] = $price + $this->vaccines[$key]['tax'];
        }
        $this->computeForAll();
    }

    protected function calculateMethods()
    {
        $total = ((float)$this->card) + ((float)$this->cash) + ((float)$this->mastercard) + ((float)$this->bank) + ((float)$this->visa) + ((float)$this->tamara) + ((float)$this->tabby);
        if ($total > $this->total) {
            $this->reset(['card', 'cash', 'mastercard', 'bank', 'visa', 'tamara', 'tabby', 'paid_tax', 'paid_without_tax']);
            $this->rest = $this->total;
        } else {
            $amount = round($this->amount_after_offers_discount, 2);
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

    /*
    public function updatedDiscount()
    {
        if ($this->discount > $this->total) {
            $this->discount = 0;
        }
        $this->computeForAll();
        $this->calculateMethods();
    } */

    public function manualCalculate()
    {
        $this->calculateMethods();
    }

    public function submit()
    {
        $data = $this->validate();

        try {
            \DB::beginTransaction();
            unset($data['items']);
            unset($data['products']);
            unset($data['vaccines']);
            unset($data['animals']);
            /* if ($this->status) {
            if ($this->status == 'Paid') {
            if ($this->rest != 0) {
            $this->addError('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
            $errors = $this->getErrorBag();
            $errors->add('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
            return redirect()->back();
            }
            }
            } */

            if ($this->status) {
                if ($this->status == 'Paid') {
                    if ($this->rest != 0) {
                        $this->addError('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                        $errors = $this->getErrorBag();
                        $errors->add('rest', 'لا يمكن عمل الحاله مسدده مع وجود متبقي مبلغ');
                        return redirect()->back();
                    }
                }
                if ($this->status == 'Unpaid') {
                    if (!$this->rest) {
                        $this->addError('rest', 'لا يمكن عمل الحاله غير مسددة مع عدم وجود متبقي مبلغ');
                        $errors = $this->getErrorBag();
                        return redirect()->back();
                    }
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
                if ($this->status == 'tab') {
                    $data['tab'] = 1;
                }
            }

            $data['invoice_number'] = $this->invoice_id;
            $data['animal_id'] = $this->animal_id;
            $data['patient_id'] = $this->patient->id ?? null;
            $data['employee_id'] = auth()->id();
            $data['total'] = $this->total;
            $data['cash'] = $this->cash ? $this->cash : 0;
            $data['bank'] = $this->bank ? $this->bank : 0;
            $data['card'] = $this->card ? $this->card : 0;
            for ($i = 1; $i <= $this->split_number; $i++) {
                $invoice = Invoice::create($data);
            }
            $invoice->products()->createMany($this->items);
            $invoice->items()->createMany($this->products);
            $invoice->items()->createMany($this->vaccines);
            foreach ($this->products as $product_item) {
                $item = Item::find($product_item['item_id']);
                $item->update(['quantity' => $item->quantity - $product_item['quantity']]);
                $item->quantities()->create([
                    'warehouse_id' => $item->quantities->first()?->warehouse_id,
                    'quantity' => $product_item['quantity'],
                    'type' => 'expense',
                ]);
            }
            $user = User::find($this->patient_key);
            //dd($user);
            //$user->animals()->createMany($this->animals);
            // foreach ($this->animals as $animal) {
            //     $userAnimal = new UserAnimal();
            //     $userAnimal->user_id = $user->id;
            //     $userAnimal->animal_id = $animal;
            //     $userAnimal->save();
            // }
            $invoice->animals()->sync($this->animals);
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
            $this->card = $this->card ? $this->card : 0;
            $this->cash = $this->cash ? $this->cash : 0;
            if ($this->cash > 0 or $this->card > 0) {
                $sum = $this->cash + $this->card;
                $points_per_amount = setting()->points_per_amount ? setting()->points_per_amount : 0;
                $point_value = setting()->point_value ? setting()->point_value : 0;
                if ($sum >= $points_per_amount and $points_per_amount > 0) {
                    $dev = (int)$sum / $points_per_amount;
                    $points = $dev * $point_value;
                    $this->patient->update(['points' => $this->patient->points + $points]);
                    PointLog::store('تم إضافة ' . $points . ' نقطة للمريض ' . $this->patient->first_name, $this->patient->id, $invoice->id);
                }
            }
            \DB::commit();
            return redirect()->route('front.invoices.index')->with('success', __('Saved successfully'));

        } catch (\Exception $e) {
            \DB::rollBack();
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function useOffer($offer_id)
    {
        $offer = PointOffer::findOrFail($offer_id);
        $this->patient->update(['points' => $this->patient->points - $offer->points]);
        PointLog::store('تم استهلاك ' . $offer->points . ' نقطة من المريض ' . $this->patient->first_name, $this->patient->id);
        return redirect()->route('front.invoices.index')->with('success', __('Saved successfully'));
    }

    public function mount()
    {
        $invoice = Invoice::latest()->first();
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        $this->scan_services = ScanService::all();
        if (request('patient_id')) {
            $this->patient_key = request('patient_id');
            $this->get_patient();
        }
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
        $points = $this->patient ? $this->patient->points : 0;
        $pointOffers = PointOffer::where('points', '<', $points)->get();
        $all_items = Item::where(function ($q) {
            if ($this->category_id) {
                $q->where('category_id', $this->category_id);
            }
        })->get();
        // dd($this->items, $this->products);
        return view('livewire.invoices.add-invoices', compact('doctors', 'categories', 'departments', 'lab_categories', 'lab_services', 'pointOffers', 'all_items'));
    }

    public function checkIfItemExists($product, $col = 'product_id', $type = 'items')
    {
        $status = false;
        $items = $this->{$type};
        foreach ($items as $key => $item) {
            if ($item[$col] == $product) {
                $items[$key]['quantity'] = $item['quantity'] + 1;
                // if (setting()->tax_enabled) {
                //     $items[$key]['tax'] = ($item['price'] * $item['quantity']) * (setting()->tax_rate / 100);
                // }
                $price = $items[$key]['price'] * $items[$key]['quantity'];
                if (setting()->tax_enabled) {
                    $tax = $price * (setting()->tax_rate / 100);
                } else {
                    $tax = 0;
                }
                $items[$key]['tax'] = $tax;
                $items[$key]['sub_total'] = $price + $tax;
                $status = true;
            }
        }
        $this->{$type} = $items;
        return $status;
    }

    public function checkIfVaccineExists($vaccine_id, $animal_id,$next_vaccine_date)
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
}

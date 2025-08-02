<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\ItemCategory;
use Carbon\Carbon;
use App\Models\Item;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Product;
use Livewire\Component;
use App\Models\Diagnose;
use App\Models\Medicine;
use App\Models\Department;
use App\Models\LabRequest;
use App\Models\Appointment;
use App\Models\PatientFile;
use App\Models\ScanRequest;
use App\Models\Notification;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\DiagnoseKeyword;
use App\Models\PharmacyRequest;
use App\Models\PharmacyMedicine;
use App\Models\PharmacyQuantity;
use App\Models\PharmacyWarehouse;
use App\Models\PharmacyPrescription;
use Barryvdh\Debugbar\Facades\Debugbar;

class DoctorInterface extends Component
{
    use WithPagination, WithFileUploads;

    public $patient, $lab_product_id;
    public $patients_screen = 'transfers';
    public $currentScreen = 'pathological-information';
    public $departments;
    public $department_id;
    public $appointment_id;
    public $diagnose_id;
    public $selectedProduct;
    public $selectedProducts = [];
    public $new_appointment, $file;
    public $items = [];
    public $product_id;
    public $notes;
    public $invoice_id;
    public $amount;
    public $total;
    public $cash;
    public $card;
    public $rest;
    public $discount = 0;
    public $tax;
    public $split;
    public $split_number;
    public $total_after_split;
    public $offers_discount;
    public $amount_after_offers_discount;
    public $scan_product_id;
    public $labs;
    //    public $categories;
    public $category_id;
    public $lab_id;
    public $dr_content;
    public $lab_cat_id;
    public $lab_serv_id;
    public $selected_department_id;
    public $scan_products = [];
    public $lab_products = [];
    public $drug_key;
    public $searched_drugs;
    public $pressure_rate;
    public $sugar_rate;
    public $body_parts = [];
    public $status;
    public $last_invoice;
    public $files;
    public $penicillin;
    public $teeth_problems;
    public $heart;
    public $fluidity;
    public $aids;
    public $strokes;
    public $tuberculosis;
    public $epilepsy;
    public $psychiatric;
    public $cancer;
    public $eating_meat;
    public $fruits_and_vegetables;
    public $smoking;
    public $other_habits;
    public $pressure;
    public $fever;
    public $anemia;
    public $thyroid_glands;
    public $liver;
    public $sugar;
    public $tb;
    public $kidneys;
    public $convulsion;
    public $other_diseases;
    public $image;
    public $date;
    public $insurance_id;
    public $insurance;
    public $is_pregnant;
    public $animal;
    public $temperature_rate;
    public $breathing_rate;
    public $heart_rate;
    public $cupping_type = [];

    public $family_fluidity;
    public $family_pressure;
    public $family_heart;
    public $family_sugar;
    public $family_liver;
    public $family_aids;
    public $family_strokes;
    public $family_epilepsy;
    public $family_kidneys;
    public $family_psychiatric;
    public $family_anemia;
    public $family_cancer;
    public $family_smoking;
    public $allergies;
    public $family_allergies;
    public $pharmaceutical;
    public $family_pharmaceutical;
    public $past_surgical;
    public $family_past_surgical;
    public $safety_of_senses;
    public $family_safety_of_senses;
    public $last_visit_question;
    public $last_visit_answer;
    public $animal_id;
    public $vaccinations = [];
    public $sensitivity = [];
    public $new_appointments = [];
    public $times = [];
    public $reservedTimes = [];
    public $medicines = [];
    public $prescription_total;
    public $selected_appointment;
    public $age;
    public $weight, $session_attachment, $all_products = [], $product_name, $product_items = [], $item_id;
    public $animal_type, $strain;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public $diagnosis = [
        'taken' => null,
        'treatment' => null,
        'current_symptoms' => null,
        'pharmaceutical' => null,
        'treatment_plan' => null,
        'tooth' => [],
        'body' => [],
        'complaint' => null,
        'clinical_examination' => null,
        'animal_id' => null,
        'period' => 'morning',
    ];
    public $drugs = [];
    public $selected_drugs = [];
    public $drug_id = [];

    public $form_type;
    /**
     * @var mixed
     */
    public $strain_id;
    public $all_items = [];
    /**
     * @var string
     */
    public $item_name;

    public function resetInputs()
    {
        $this->reset(['session_attachment', 'selected_drugs', 'patient', 'appointment_id', 'selectedProduct', 'selectedProducts', 'new_appointment', 'items', 'product_id', 'notes', 'invoice_id', 'amount', 'total', 'cash', 'card', 'rest', 'discount', 'tax', 'split', 'split_number', 'total_after_split', 'offers_discount', 'amount_after_offers_discount', 'scan_product_id', 'dr_content', 'animal_id']);
    }

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'diagnosis.taken' => 'required',
            // 'diagnosis.treatment' => 'required',
            'diagnosis.current_symptoms' => 'required',
            'diagnosis.treatment_plan' => 'nullable',
            'diagnosis.pharmaceutical' => 'nullable',
            'diagnosis.tooth' => doctor()->is_dentist ? 'required' : 'nullable',
            'diagnosis.body' => doctor()->is_dermatologist ? 'required' : 'nullable',
            'diagnosis.period' => 'nullable',
            'diagnosis.next_visit' => 'nullable',
            'amount' => 'nullable',
            'total' => 'nullable',
            'cash' => 'nullable',
            'card' => 'nullable',
            'rest' => 'nullable',
            'discount' => 'nullable',
            'notes' => 'nullable',
            'tax' => 'nullable',
            'animal_id' => 'required',
        ];
    }

    public function selectPatient($id)
    {
        $this->appointment_id = $id;
        $this->selected_appointment = doctor()->appointments()->find($id);
        $this->patient = $this->selected_appointment->patient;
        $this->animal = $this->selected_appointment->animal;
        $this->animal_id = $this->selected_appointment->animal_id;
        $this->strain_id = $this->animal?->strain_id;
        $this->penicillin = $this->patient->penicillin;
        $this->teeth_problems = $this->patient->teeth_problems;
        $this->drugs = $this->patient->drugs;
        $this->heart = $this->patient->heart;
        $this->pressure = $this->patient->pressure;
        $this->fever = $this->patient->fever;
        $this->anemia = $this->patient->anemia;
        $this->thyroid_glands = $this->patient->thyroid_glands;
        $this->liver = $this->patient->liver;
        $this->sugar = $this->patient->sugar;
        $this->tb = $this->patient->tb;
        $this->kidneys = $this->patient->kidneys;
        $this->convulsion = $this->patient->convulsion;
        $this->other_diseases = $this->patient->other_diseases;
        $this->is_pregnant = $this->patient->is_pregnant;
        $this->fluidity = $this->patient->fluidity;
        $this->aids = $this->patient->aids;
        $this->strokes = $this->patient->strokes;
        $this->tuberculosis = $this->patient->tuberculosis;
        $this->epilepsy = $this->patient->epilepsy;
        $this->psychiatric = $this->patient->psychiatric;
        $this->cancer = $this->patient->cancer;
        $this->eating_meat = $this->patient->eating_meat;
        $this->fruits_and_vegetables = $this->patient->fruits_and_vegetables;
        $this->smoking = $this->patient->smoking;
        $this->other_habits = $this->patient->other_habits;
        $this->family_fluidity = $this->patient->family_fluidity;
        $this->family_pressure = $this->patient->family_pressure;
        $this->family_heart = $this->patient->family_heart;
        $this->family_sugar = $this->patient->family_sugar;
        $this->family_liver = $this->patient->family_liver;
        $this->family_aids = $this->patient->family_aids;
        $this->family_strokes = $this->patient->family_strokes;
        $this->family_epilepsy = $this->patient->family_epilepsy;
        $this->family_kidneys = $this->patient->family_kidneys;
        $this->family_psychiatric = $this->patient->family_psychiatric;
        $this->family_anemia = $this->patient->family_anemia;
        $this->family_cancer = $this->patient->family_cancer;
        $this->family_smoking = $this->patient->family_smoking;
        $this->allergies = $this->patient->allergies;
        $this->family_allergies = $this->patient->family_allergies;
        $this->pharmaceutical = $this->patient->pharmaceutical;
        $this->family_pharmaceutical = $this->patient->family_pharmaceutical;
        $this->past_surgical = $this->patient->past_surgical;
        $this->family_past_surgical = $this->patient->family_past_surgical;
        $this->safety_of_senses = $this->patient->safety_of_senses;
        $this->family_safety_of_senses = $this->patient->family_safety_of_senses;
        $this->last_visit_question = $this->patient->last_visit_question;
        $this->last_visit_answer = $this->patient->last_visit_answer;
        $this->last_invoice = Invoice::where('patient_id', $this->patient->id)->where(function ($q) {
            $q->where('created_at', $this->selected_appointment->appointment_date)->orWhere('created_at', date('Y-m-d'));
        })->first();
        $diagnose = Diagnose::where('appointment_id', $id)->where('patient_id', $this->patient->id)->first();
        if ($diagnose) {
            $this->sugar_rate = $diagnose->sugar_rate;
            $this->pressure_rate = $diagnose->pressure_rate;
            // $this->age = $diagnose->age;
            $this->weight = $diagnose->weight;
            $this->breathing_rate = $diagnose->breathing_rate;
            $this->temperature_rate = $diagnose->temperature_rate;
            $this->heart_rate = $diagnose->heart_rate;
            $this->body_parts = $diagnose->body_parts ?? [];
            $this->diagnosis['treatment'] = $diagnose->treatment;
            $this->diagnosis['current_symptoms'] = $diagnose->current_symptoms;
            $this->diagnosis['clinical_examination'] = $diagnose->clinical_examination;
            $this->diagnosis['pharmaceutical'] = $diagnose->pharmaceutical;
            $this->diagnosis['treatment_plan'] = $diagnose->treatment_plan;
            $this->files = $diagnose->attachments;
        }
    }

    //addDiagnosis

    public function addMedicine()
    {
        $this->medicines[] = [
            'pharmacy_medicine_id' => '',
            'quantity' => '',
            'duration' => '',
            'price' => '',
            'total' => '',
            'pharmacy_warehouse_id' => setting()->main_pharmacy_warehouse_id
        ];
    }

    public function removeMedicine($index)
    {
        unset($this->medicines[$index]);
    }

    public function calculatePrescriptionTotal()
    {
        $totalChanged = false;
        $selectedMedicineIds = [];
        foreach ($this->medicines as $key => $medicine) {
            $quantity = $medicine['quantity'] ?? 0;
            $pharmacyMedicineId = $medicine['pharmacy_medicine_id'];
            $pharmacyMedicine = PharmacyMedicine::find($pharmacyMedicineId);
            $pharmacyWarehouse = PharmacyWarehouse::find($medicine['pharmacy_warehouse_id']);
            $pharmacyMedicine_quantity = getProductQuantityInWarehouse($pharmacyMedicine, $pharmacyWarehouse);

            if ($pharmacyMedicineId) {
                if (in_array($pharmacyMedicineId, $selectedMedicineIds)) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'لا يمكن اختيار الدواء نفسه مرتين']);
                    $this->medicines[$key]['pharmacy_medicine_id'] = null;
                    $this->medicines[$key]['quantity'] = 0;
                    $this->medicines[$key]['total'] = 0;
                    continue;
                }
                $selectedMedicineIds[] = $pharmacyMedicineId;
            }

            if ($pharmacyMedicine && is_numeric($quantity) && $quantity > 0) {
                if ($pharmacyMedicine_quantity >= $quantity) {
                    $newTotal = $pharmacyMedicine->selling_price * $quantity;
                    $this->medicines[$key]['price'] = $pharmacyMedicine->selling_price;
                } else {
                    $newTotal = 0;
                    $this->medicines[$key]['quantity'] = 0;
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'الكمية غير متاحة']);
                }
            } else {
                if (!$pharmacyMedicine) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'اختر الدواء اولا']);
                } elseif ($quantity <= 0) {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'الكميه يجب ان تكون 1 او اكبر']);
                }

                $this->medicines[$key]['quantity'] = 0;
                $newTotal = 0;
            }

            if ($this->medicines[$key]['total'] != $newTotal) {
                $this->medicines[$key]['total'] = $newTotal;
                $totalChanged = true;
            }
        }

        if ($totalChanged) {
            $this->prescription_total = array_sum(array_column($this->medicines, 'total'));
            $this->emit('refreshComponent');
        }
    }

    public function addPrescription()
    {
        $this->validate([
            'medicines.*.*' => 'required'
        ]);
        $prescription = PharmacyPrescription::create([
            'appointment_id' => $this->selected_appointment->id,
        ]);
        $prescription->items()->createMany($this->medicines);
        $tax = 0;
        if (setting()->tax_enabled && $this->selected_appointment?->patient?->country_id != 1) {
            $tax = ($this->prescription_total) * (setting()->tax_rate / 100);
        }
        $invoice = Invoice::create([
            'invoice_number' => Invoice::max('id') ? Invoice::max('id') + 1 : 1,
            'total' => $this->prescription_total,
            'tax' => $tax,
            'patient_id' => $this->patient->id,
            'animal_id' => $this->animal_id,
            'employee_id' => auth()->id(),
            'dr_id' => auth()->id(),
            'pharmacy_prescription_id' => $prescription->id,
        ]);
        foreach ($this->medicines as $medicine) {
            PharmacyQuantity::create([
                'type' => 'expense',
                'quantity' => $medicine['quantity'],
                'from_warehouse_id' => $medicine['pharmacy_warehouse_id'],
                'employee_id' => auth()->id(),
                'item_id' => $medicine['pharmacy_medicine_id'],
                'item_type' => PharmacyMedicine::class,
                'operational_number' => PharmacyQuantity::max('operational_number') ?
                    PharmacyQuantity::max('operational_number') + 1 : 5000
            ]);

            $invoice->items()->create([
                'sub_total' => $medicine['total'],
                'price' => $medicine['price'],
                'quantity' => $medicine['quantity'],
                'pharmacy_medicine_id' => $medicine['pharmacy_medicine_id']
            ]);
        }

        $this->reset('medicines', 'prescription_total');
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم اصدار الوصفة بنجاح']);
    }

    public function add_product()
    {
        if ($this->patient) {
            if ($this->product_id) {
                $product = Product::with('department')->find($this->product_id);
                if ($product) {
                    // $tax = $product->tax;
                    if (setting()->tax_enabled) {
                        $tax = $product->price * (setting()->tax_rate / 100);
                    } else {
                        $tax = 0;
                    }
                    $discount = 0;
                    $offer = null;
                    if ($product->offer) {
                        $discount = $product->price * ($product->offer->rate / 100);
                        $offer = $product->offer->id;
                    }
                    $total = $product->price - $discount + $tax;
                    if (!$this->checkIfItemExists($product->id)) {
                        $this->items[] = ['invoice_id' => $this->invoice_id, 'product_id' => $product->id, 'product_name' => $product->name, 'tax_type' => $product->tax_type, 'tax_type_ar' => $product->taxTypeAr, 'amount' => $product->amount, 'price' => $product->price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $product->department->id, 'department' => $product->department->name, 'is_lab' => $product->department->is_lab, 'is_scan' => $product->department->is_scan, 'tax' => $tax ?? 0, 'offer_id' => $offer];
                    }

                    $this->computeForAll();
                    //$this->product_id = null;
                } else {
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('رقم الخدمة المدخل لا يتوفر في هذا القسم')]);
                    //$this->product_id = null;
                }
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Please select the patient first')]);
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
                $category = ItemCategory::find($this->category_id);
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
                        if (!$this->checkIfItemExists($item->id, 'item_id', 'product_items')) {
                            // dd($item, $category);
                            if (!$category) {
                                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('برجاء اختيار القسم')]);
                            } else {
                                $this->product_items[] = [
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

    public function changeQtyAndComputeItems($key)
    {
        // $price = $this->items[$key]['price'] * $this->items[$key]['quantity'];
        $price = (float)$this->items[$key]['price'] * (int)$this->items[$key]['quantity'];
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
        $price = $this->product_items[$key]['price'] * $this->product_items[$key]['quantity'];
        if (setting()->tax_enabled) {
            $tax = $price * (setting()->tax_rate / 100);
        } else {
            $tax = 0;
        }
        $this->product_items[$key]['tax'] = $tax;
        $this->product_items[$key]['sub_total'] = $price + $tax;
        $this->computeForAll();
    }

    public function add_item_barcode()
    {
        if ($this->patient) {
            $item = null;
            if ($this->item_id) {
                // $item = Item::find($this->item_id);
                $item = Item::where('barcode', $this->item_id)->first();

                // $this->department_id = $item->department_id;
                $department = Department::find($this->department_id);
                if ($item) {
                    if ($item->allow_quantity && $item->quantity > 0) {
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
                                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('برجاء اختيار القسم')]);
                            } else {
                                $this->product_items[] = ['invoice_id' => $this->invoice_id, 'item_id' => $item->id, 'product_name' => $item->name, 'price' => $item->sale_price, 'discount' => $discount, 'quantity' => 1, 'sub_total' => $total, 'department_id' => $this->department_id, 'department' => $department->name, 'tax_type' => $item->tax_type, 'tax_type_ar' => $item->taxTypeAr, 'tax' => $tax, 'amount' => $item->amount, 'offer_id' => $offer];
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


    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function delete_product($key)
    {
        unset($this->product_items[$key]);
        $this->computeForAll();
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

    // public function computeForAll()
    // {
    //     $this->amount = array_reduce($this->items, function ($carry, $item) {
    //         $quantity = $item['quantity'] ? $item['quantity'] : 1;
    //         $price = $item['amount'] ? $item['amount'] * $quantity : 0;
    //         $carry += $price;
    //         return $carry;
    //     });

    //     $this->tax = array_reduce($this->items, function ($carry, $item) {
    //         $carry += $item['tax'];
    //         return $carry;
    //     });
    //     $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
    //         $carry += $item['discount'];
    //         return $carry;
    //     });
    //     $this->total = $this->amount + $this->tax - $this->discount;
    //     $this->amount_after_offers_discount = $this->amount - $this->offers_discount;
    //     if ($this->split_number == "" or $this->split_number == 0) {
    //         $this->split_number = 1;
    //     }
    //     /* $this->total = $this->amount + $this->tax - $this->discount; */
    //     $this->total_after_split = $this->total / $this->split_number;
    //     $this->rest = $this->total - $this->discount;
    //     $this->cash = 0;
    //     $this->card = 0;
    // }

    // public function changeItemTotal($key)
    // {
    //     $price = $this->items[$key]['amount'] ? $this->items[$key]['amount'] : 0;
    //     $this->items[$key]['amount'] = $price;
    //     if (setting()->tax_enabled) {
    //         $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
    //     }
    //     $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
    //     $this->computeForAll();
    // }

    public function addInvoice()
    {
        $data = $this->validate([
            'amount' => 'required',
            'total' => 'required',
            'cash' => 'nullable',
            'card' => 'nullable',
            'rest' => 'nullable',
            'discount' => 'nullable',
            'notes' => 'nullable',
            'tax' => 'nullable',
            'selected_department_id' => 'required',
            'product_id' => 'required',
            'animal_id' => 'required'
        ]);
        $invoice = Invoice::latest()->first();
        $this->invoice_id = $invoice ? $invoice->id + 1 : 1;
        $data['invoice_number'] = $this->invoice_id;
        $data['patient_id'] = $this->patient->id;
        $data['dr_id'] = doctor()->id;
        $data['status'] = 'Unpaid';
        $data['animal_id'] = $this->animal_id;
        $data['employee_id'] = auth()->id();
        $data['department_id'] = $this->selected_department_id;
        $data['total'] = $this->total;
        $data['tax'] = $this->tax ?? 0;

        // dd($this->items);
        $department = Department::find($this->selected_department_id);

        if ($department && $department->is_lab) {
            $data['is_lab'] = 1;
        }

        for ($i = 1; $i <= $this->split_number; $i++) {
            $invoice = Invoice::create($data);
            $invoice->products()->createMany($this->items);
            $invoice->items()->createMany($this->product_items);
        }
        foreach ($this->product_items as $product_item) {
            $item = Item::find($product_item['item_id']);
            $item->update(['quantity' => $item->quantity - $product_item['quantity']]);
        }

        $this->currentScreen = 'pathological-information';
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update(['appointment_status' => 'examined']);


        $users = User::where('type', 'admin')->orWhere('type', 'recep')->get();
        $title = 'تم إضافة فاتورة جديدة رقم  ' . $invoice->id;
        $link = route('front.invoices.edit', $invoice->id);
        foreach ($users as $key => $user) {
            Notification::send($user->id, $title, $link, 'invoice');
        }


        //$this->resetInputs();
        session()->flash('success', 'تم انشاء الفاتورة بنجاح وسيتم انهاء الجلسه');
        $this->endSession();
        return redirect()->route('doctor.interface');
    }

    public function saveDiagnose()
    {
        $data = $this->validate([
            //'diagnosis.taken' => 'required',
            // 'diagnosis.treatment' => 'required',
            'diagnosis.current_symptoms' => 'nullable',
            'diagnosis.pharmaceutical' => 'nullable',
            'diagnosis.treatment_plan' => 'nullable',
            'diagnosis.clinical_examination' => 'nullable',
            'diagnosis.next_visit' => 'nullable',
            'diagnosis.files' => 'nullable'
        ]);
        $files = isset($data['diagnosis']['files']) ? $data['diagnosis']['files'] : null;
        $appointment = Appointment::find($this->appointment_id);

        $diagnose = Diagnose::where('appointment_id', $appointment->id)->first();

        if ($diagnose) {
            $diagnose->update([
                'appointment_id' => $appointment->id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => null,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
                'period' => $appointment->appointment_duration,
                'animal_id' => $appointment->animal_id,
                'treatment' => $this->diagnosis['treatment'],
                'current_symptoms' => $this->diagnosis['current_symptoms'],
                'next_visit' => isset($this->diagnosis['next_visit']) ? $this->diagnosis['next_visit'] : '',
                'pharmaceutical' => $this->diagnosis['pharmaceutical'],
                'treatment_plan' => $this->diagnosis['treatment_plan'],
                'clinical_examination' => $this->diagnosis['clinical_examination'],
                'sugar_rate' => $this->sugar_rate,
                'pressure_rate' => $this->pressure_rate,
                // 'age' => $this->age,
                'weight' => $this->weight,
                'animal_type' => $this->animal_type,
                'strain_id' => $this->strain_id,
                'heart_rate' => $this->heart_rate,
                'breathing_rate' => $this->breathing_rate,
                'temperature_rate' => $this->temperature_rate,
                'cupping_type' => $this->cupping_type,
                'body_parts' => $this->body_parts,
            ]);
        } else {
            $diagnose = Diagnose::create([
                'appointment_id' => $appointment->id,
                'patient_id' => $this->patient->id,
                'dr_id' => doctor()->id,
                'department_id' => null,
                'time' => date('H:i'),
                'day' => date('Y-m-d'),
                'period' => $appointment->appointment_duration,
                'animal_id' => $appointment->animal_id,
                'treatment' => $this->diagnosis['treatment'],
                'current_symptoms' => $this->diagnosis['current_symptoms'],
                'pharmaceutical' => $this->diagnosis['pharmaceutical'],
                'treatment_plan' => $this->diagnosis['treatment_plan'],
                'clinical_examination' => $this->diagnosis['clinical_examination'],
                'next_visit' => isset($this->diagnosis['next_visit']) ? $this->diagnosis['next_visit'] : '',
                'sugar_rate' => $this->sugar_rate,
                'pressure_rate' => $this->pressure_rate,
                // 'age' => $this->age,
                'weight' => $this->weight,
                'animal_type' => $this->animal_type,
                'strain_id' => $this->strain_id,
                'heart_rate' => $this->heart_rate,
                'breathing_rate' => $this->breathing_rate,
                'temperature_rate' => $this->temperature_rate,
                'cupping_type' => $this->cupping_type,
                'body_parts' => $this->body_parts,
            ]);
        }

        $diagnose->appoint?->update(['attended_at' => Carbon::now()]);

        if (isset($files) && is_array($files) && count($files)) {
            foreach ($files as $file) {
                $filePath = store_file($file, 'diagnose/attachments');
                $diagnose->attachments()->create(['file' => $filePath]);
            }
        }
        $this->emit('refreshComponent');
        /* Diagnose::query()->create(array_merge([
        'appointment_id' => $this->appointment_id,
        'patient_id' => $this->patient->id,
        'dr_id' => doctor()->id,
        'department_id' => doctor()->department_id,
        'time' => date('H:i'),
        'day' => date('Y-m-d'),
        ], $this->diagnosis)); */
        $this->diagnose_id = $diagnose->id;
        $this->currentScreen = 'invoice';
        //$this->resetInputs();
        //$this->reset();
        session()->flash('success', 'تم اضافة التشخيص بنجاح');
    }


    //transferPatient
    public function transferPatient()
    {
        $data = array_merge([
            'appointment_status' => 'transferred',
        ], $this->new_appointment);
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update($data);
        /* Appointment::query()->create($data); */
        $this->currentScreen = 'invoice';
        // $this->resetInputs();
        session()->flash('success', 'تم تحويل المريض ');
    }


    //endSession
    public function endSession()
    {
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update(['appointment_status' => 'examined']);
        $users = User::where('type', 'admin')->orWhere('type', 'recep')->get();
        $title = 'تم إنهاء الكشف للمريض ' . $this->patient->name;
        $link = route('front.patients.show', $this->patient->id);
        foreach ($users as $key => $user) {
            Notification::send($user->id, $title, $link, 'appointment');
        }
        $this->resetInputs();
        session()->flash('success', 'تم إنهاء الكشف بنجاح');
    }

    //suspendSessionSession
    public function suspendSession()
    {
        $old_appointment = doctor()->appointments()->find($this->appointment_id);
        $old_appointment->update(['appointment_status' => 'suspend']);
        $users = User::where('type', 'admin')->orWhere('type', 'recep')->get();
        $title = 'تم تعليق الكشف للمريض ' . $this->patient->name;
        $link = route('front.patients.show', $this->patient->id);
        foreach ($users as $key => $user) {
            Notification::send($user->id, $title, $link, 'appointment');
        }
        $this->resetInputs();
        session()->flash('success', 'تم تعليق الكشف بنجاح');
    }


    public function saveScan()
    {
        $data = [];
        $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
        ]);
        $data['type'] = 'scan';
        $data['file_type'] = $this->file->extension();
        $data['file_size'] = $this->file->getSize();
        $data['file_name'] = $this->dr_content;
        $data['file_path'] = store_file($this->file, 'lab');
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = doctor()->id;
        $data['animal_id'] = $this->animal_id;
        PatientFile::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ الأشعة بنجاح');
    }


    public function saveLab()
    {
        $data = [];
        $this->validate([
            'file' => 'required|mimes:pdf,jpg,png',
            'dr_content' => 'required',
            'form_type' => 'required'
        ]);
        $data['type'] = 'lab';
        $data['file_type'] = $this->file->extension();
        $data['file_size'] = $this->file->getSize();
        $data['file_name'] = $this->dr_content;
        $data['file_path'] = store_file($this->file, 'lab');
        $data['patient_id'] = $this->patient->id;
        $data['employee_id'] = doctor()->id;
        $data['animal_id'] = $this->animal_id;
        $data['form_type'] = $this->form_type;
        PatientFile::create($data);
        $this->reset(['file', 'dr_content']);
        session()->flash('success', ' تم حفظ التحليل بنجاح');
    }

    public function scan_request()
    {
        $data = $this->validate([
            'scan_product_id' => 'required',
            'dr_content' => 'required',
            'file' => 'nullable|file'
        ]);
        $appointment = Appointment::find($this->appointment_id);

        unset($data['scan_product_id']);
        $data['dr_id'] = doctor()->id;
        $data['patient_id'] = $this->patient->id;
        $data['clinic_id'] = $this->department_id;
        $data['appointment_id'] = $this->appointment_id;
        $data['status'] = 'pending';
        $data['product_id'] = $this->scan_product_id;
        $data['file'] = $this->file ? store_file($this->file, 'scanRequests') : null;
        $data['animal_id'] = $appointment->animal_id;
        ScanRequest::create($data);
        $this->reset(['dr_content', 'scan_product_id', 'category_id', 'lab_id']);
        session()->flash('success', ' تم إرسال طلب الأشعة بنجاح');
    }

    public function lab_request()
    {
        $data = $this->validate([
            'lab_product_id' => 'required',
            'dr_content' => 'required',
            'file' => 'nullable|file'
        ]);
        $appointment = Appointment::find($this->appointment_id);

        unset($data['lab_product_id']);
        $data['doctor_id'] = doctor()->id;
        $data['patient_id'] = $this->patient->id;
        $data['clinic_id'] = $this->department_id;
        $data['appointment_id'] = $this->appointment_id;
        $data['status'] = 'pending';
        $data['product_id'] = $this->lab_product_id;
        $data['file'] = $this->file ? store_file($this->file, 'labRequests') : null;
        $data['animal_id'] = $appointment->animal_id;
        LabRequest::create($data);
        $this->reset(['dr_content', 'lab_product_id', 'category_id', 'lab_id']);
        session()->flash('success', ' تم إرسال طلب المختبر بنجاح');
    }

    public function mount()
    {
        $this->addMedicine();
        $this->drugs = Medicine::all();
        Debugbar::info($this->drugs);
        $this->department_id = doctor()->department_id;
        $department_scan_id = Department::where('is_scan', 1)->first()?->id;
        if ($department_scan_id) {
            $this->scan_products = Product::where('department_id', $department_scan_id)->get();
        }
        $department_lab_id = Department::where('is_lab', 1)->first()?->id;
        if ($department_lab_id) {
            $this->lab_products = Product::where('department_id', $department_lab_id)->get();
        }
        $this->new_appointment = [
            'appointment_date' => null,
            'appointment_time' => null,
            'doctor_id' => Doctor::query()->first()?->id,
            'clinic_id' => Department::query()->first()?->id,
        ];

        $this->new_appointments[] = [
            'room_id' => null,
            'appointment_duration' => '',
            'appointment_date' => '',
            'appointment_time' => '',
            'times' => [],
            'reservedTimes' => [],
        ];


        $this->vaccinations = [
            ['']
        ];

        $this->sensitivity = [
            ['']
        ];
    }

    public function getTimes($index, $appointment_date, $appointment_duration)
    {

        // get only hour from time type
        $from_morning = Carbon::parse(setting()->from_morning)->format('H');
        $to_morning = Carbon::parse(setting()->to_morning)->format('H');
        $from_evening = Carbon::parse(setting()->from_evening)->format('H');
        $to_evening = Carbon::parse(setting()->to_evening)->format('H');
        if ($appointment_duration == 'morning') {
            for ($i = $from_morning; $i < $to_morning; $i++) {
                $this->new_appointments[$index]['times'][] = $i . ':00';
                $this->new_appointments[$index]['times'][] = $i . ':30';
            }

            $this->new_appointments[$index]['reservedTimes'] = Appointment::where('appointment_date', $appointment_date)
                ->where('appointment_time', '>=', $from_morning)
                ->where('appointment_time', '<=', $to_morning)
                ->pluck('appointment_time')->toArray();
        } elseif ($appointment_duration == 'evening') {
            for ($i = $from_evening; $i < $to_evening; $i++) {
                $this->new_appointments[$index]['times'][] = $i . ':00';
                $this->new_appointments[$index]['times'][] = $i . ':30';
            }
            $this->new_appointments[$index]['reservedTimes'] = Appointment::where('appointment_date', $appointment_date)
                ->where('appointment_time', '>=', $from_evening)
                ->where('appointment_time', '<=', $to_evening)
                ->pluck('appointment_time')->toArray();
        }
    }

    public function addNewAppoinment()
    {

        $this->new_appointments[] = [
            'room_id' => null,
            'appointment_duration' => '',
            'appointment_date' => '',
            'appointment_time' => '',
            'times' => [],
            'reservedTimes' => [],
        ];
    }


    public function removeAppoinment($index)
    {
        unset($this->new_appointments[$index]);
        $this->new_appointments = array_values($this->new_appointments);
    }

    public function saveAppointment()
    {
        $this->validate([
            'new_appointments.*' => 'required'
        ]);
        if ($this->new_appointments) {
            foreach ($this->new_appointments as $app) {
                Appointment::create([
                    'patient_id' => $this->patient->id,
                    'animal_id' => $this->animal_id,
                    'clinic_id' => $this->department_id,
                    'doctor_id' => doctor()->id,
                    'appointment_time' => $app['appointment_time'],
                    'appointment_date' => $app['appointment_date'],
                    'appointment_duration' => $app['appointment_duration'],
                    'room_id' => $app['room_id'] == '' ? null : $app['room_id'],
                ]);
            }
        }

        $this->reset(['new_appointments']);
        $this->currentScreen = 'current';

        session()->flash('success', ' تم حجز المواعيد بنجاح');
    }

    public function addNewVaccination()
    {
        $this->vaccinations[] = [''];
    }

    public function addNewSensitivity()
    {
        $this->sensitivity[] = [''];
    }

    public function removeVaccination($index)
    {
        unset($this->vaccinations[$index]);
        $this->vaccinations = array_values($this->vaccinations);
    }

    public function removeSensitivity($index)
    {
        unset($this->sensitivity[$index]);
        $this->sensitivity = array_values($this->sensitivity);
    }

    //updatedServiceId
    public function updatedDrugKey()
    {
        if ($this->drug_key) {
            $this->searched_drugs = Medicine::where('name_ar', 'LIKE', "%$this->drug_key%")->orWhere('name_en', 'LIKE', "%$this->drug_key%")->take(10)->get();
        }
    }

    public function selectDrug(Medicine $drug)
    {
        if ($drug) {
            $newArr = array_filter($this->selected_drugs, function ($item) use ($drug) {
                return $item['id'] == $drug->id;
            });

            if (count($newArr) > 0) {
                $key = array_keys($newArr)[0];
                ++$this->selected_drugs[$key]['quantity'];

                $this->selected_drugs[$key]['name_ar'] = $drug->name_ar;
            } else {
                $this->selected_drugs[] = [
                    'id' => $drug->id,
                    'name_ar' => $drug->name_ar,
                    'quantity' => 1
                ];
            }
        }
    }

    public function hydrate()
    {
        $this->dispatchBrowserEvent('refreshSelect2');
    }

    public function render()
    {
        // $this->drugs = Medicine::get();
        // return view('livewire.doctor-interface',['drugs'=>$this->drugs]);
        $keywords = DiagnoseKeyword::get();
        $all_items = Item::get();
        $this->setTimesNewAppointss();
        $categories = ItemCategory::get();
        $this->departments = Department::whereIn('id', json_decode(doctor()->show_department_products) ?? [])->get();


        return view('livewire.doctor-interface', compact('keywords', 'all_items', 'categories'));
    }

    public function setTimesNewAppointss() {}

    public function doctorAttended()
    {
        $this->selected_appointment->update(['doctor_attended_at' => Carbon::now()]);
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم تحضير المريض بنجاح']);
    }

    // drug_request
    public function drug_request()
    {
        $drugsIds = collect($this->selected_drugs)->pluck('id')->toArray();
        $drugsQtys = collect($this->selected_drugs)->pluck('quantity')->toArray();

        //dd(array_combine($drugsIds, $drugsQtys));
        $data = [
            'doctor_id' => doctor()->id,
            'patient_id' => $this->patient->id,
            'clinic_id' => doctor()->department->id,
            'drugs' => array_combine($drugsIds, $drugsQtys),
            'drugs_quantity' => $drugsQtys,
            'notes' => $this->dr_content,
            'status' => 'pending'
        ];
        /* foreach ($this->selected_drugs as $drug) {
        $data['drugs']= array($drug['id']);
        } */

        PharmacyRequest::create($data);
        Debugbar::info($data);

        //$res = Http::post(env('PHARMACY_API_URL') . '/drug-request', $data);
        //Debugbar::info($res->body());
        $this->resetInputs();
        session()->flash('success', ' تم إرسال طلب الأدوية بنجاح');
    }


    public function updatePatientData($id)
    {
        $patient = Patient::find($id);

        $patient->update([
            'penicillin' => $this->penicillin,
            'teeth_problems' => $this->teeth_problems,
            'drugs' => $this->drugs,
            'heart' => $this->heart,
            'pressure' => $this->pressure,
            'fever' => $this->fever,
            'anemia' => $this->anemia,
            'thyroid_glands' => $this->thyroid_glands,
            'liver' => $this->liver,
            'sugar' => $this->sugar,
            'tb' => $this->tb,
            'kidneys' => $this->kidneys,
            'convulsion' => $this->convulsion,
            'other_diseases' => $this->other_diseases,
            'is_pregnant' => $this->is_pregnant,
            'fluidity' => $this->fluidity,
            'aids' => $this->aids,
            'strokes' => $this->strokes,
            'tuberculosis' => $this->tuberculosis,
            'epilepsy' => $this->epilepsy,
            'psychiatric' => $this->psychiatric,
            'cancer' => $this->cancer,
            'eating_meat' => $this->eating_meat,
            'fruits_and_vegetables' => $this->fruits_and_vegetables,
            'smoking' => $this->smoking,
            'other_habits' => $this->other_habits,
            'family_fluidity' => $this->family_fluidity,
            'family_pressure' => $this->family_pressure,
            'family_heart' => $this->family_heart,
            'family_sugar' => $this->family_sugar,
            'family_liver' => $this->family_liver,
            'family_aids' => $this->family_aids,
            'family_strokes' => $this->family_strokes,
            'family_epilepsy' => $this->family_epilepsy,
            'family_kidneys' => $this->family_kidneys,
            'family_psychiatric' => $this->family_psychiatric,
            'family_anemia' => $this->family_anemia,
            'family_cancer' => $this->family_cancer,
            'family_smoking' => $this->family_smoking,
            'allergies' => $this->allergies,
            'family_allergies' => $this->family_allergies,
            'pharmaceutical' => $this->pharmaceutical,
            'family_pharmaceutical' => $this->family_pharmaceutical,
            'past_surgical' => $this->past_surgical,
            'family_past_surgical' => $this->family_past_surgical,
            'safety_of_senses' => $this->safety_of_senses,
            'family_safety_of_senses' => $this->family_safety_of_senses,
            'last_visit_question' => $this->last_visit_question,
            'last_visit_answer' => $this->last_visit_answer,
        ]);

        session()->flash('success', __('Saved successfully'));
        $this->currentScreen = 'current';
    }

    public function saveSessionAttachment()
    {
        if ($this->session_attachment) {
            $appointment = Appointment::find($this->appointment_id);
            if ($appointment) {
                if (!is_null($appointment->session_attachment)) {
                    delete_file($appointment->session_attachment);
                }
                $appointment->update(['session_attachment' => store_file($this->session_attachment, 'appointments')]);
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Saved.')]);
            } else {
            }
        }
    }

    public function addBodyParts($left, $top)
    {
        $this->body_parts[] = [
            'left' => $left,
            'top' => $top,
        ];
    }

    public function removeBodyParts()
    {
        // remove last element
        array_pop($this->body_parts);
    }


    public function getProduct($value)
    {
        if ($value) {
            if ($this->selected_department_id) {

                $products = Product::where('name', 'LIKE', '%' . $value . '%')->where('department_id', $this->selected_department_id)->get();
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
        $this->computeForAll();
    }
    // public function calculateNet()
    // {
    //     $this->card = $this->card == "" ? 0 : $this->card;
    //     $this->cash = $this->cash == "" ? 0 : $this->cash;
    //     $this->discount = $this->discount == "" ? 0 : $this->discount;
    //     $this->rest
    //         = $this->total
    //         - ($this->card + $this->cash + $this->discount);
    // }


    public function computeForAll()
    {
        // dd($this->items) ;
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $quantity = $item['quantity'] ? $item['quantity'] : 1;
            $price = $item['price'] ? $item['price'] * $quantity : 0;
            $carry += round($price, 2);
            return $carry;
        }) + array_reduce($this->product_items, function ($carry, $item) {
            $quantity = $item['quantity'] ? $item['quantity'] : 1;
            $price = $item['price'] ? $item['price'] * $quantity : 0;
            $carry += round($price, 2);
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['tax'];
            return $carry;
        }) + array_reduce($this->product_items, function ($carry, $item) {
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
            $my_quantity += (int)$item["quantity"];
        }


        $products_quantity = 0;
        foreach ($this->product_items as $item) {
            $products_quantity += $item["quantity"];
        }


        // old calculation
        // $this->total = $this->amount + ($this->tax) - $this->discount - $this->offers_discount;
        // new calculation
        $this->total = round($this->amount + $this->tax - $this->discount - $this->offers_discount, 2);

        $this->amount_after_offers_discount =  round($this->amount - $this->offers_discount, 2);
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
        $this->cash = $this->total;
        $this->calculateNet();
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
        $price = $this->items[$key]['price'] ? $this->items[$key]['price'] * $this->items[$key]['quantity'] : 0;
        $this->items[$key]['price'] = $price;
        if (setting()->tax_enabled) {
            $this->items[$key]['tax'] = $price * (setting()->tax_rate / 100);
        }
        $this->items[$key]['sub_total'] = $price + $this->items[$key]['tax'];
        $this->computeForAll();
    }

    public function updatedDiscount()
    {
        $this->computeForAll();
    }
}
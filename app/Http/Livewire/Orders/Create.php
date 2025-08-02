<?php

namespace App\Http\Livewire\Orders;

use App\Models\Item;
use App\Models\Order;
use App\Models\Patient;
use Livewire\Component;
use App\Models\ItemCategory;
use Illuminate\Http\Request;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions;

class Create extends Component
{
    public $order_id, $date, $payment_method, $item_id, $items = [], $amount, $tax, $total, $discount = 0,
        $client_phone, $client_id, $animal_id, $client, $edit_mode = false,
        $unpaid_order_id, $order, $qrCode, $cash = 0, $card, $not_paid,
        $offers_discount, $amount_after_offers_discount, $rest,
        $product_id, $product_name, $category_id, $qr_code;

    public function getClient()
    {
        if ($this->client_phone) {
            $this->client = Patient::where('phone', $this->client_phone)->first();
            if ($this->client) {
                $this->client_id = $this->client->id;
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إيجاد العميل بنجاح']);
            } else {
                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'عذرا, لم يتم إيجاد العميل']);
            }
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يرجى إدخال رقم العميل']);
        }
    }

    public function edit()
    {
        $this->order_id = $this->unpaid_order_id;
        $this->edit_mode = true;
        $this->order = Order::findOrFail($this->order_id);
        $this->date = $this->order->date;
        $this->items = $this->order->items()->get()->toArray();
        $this->discount = $this->order->discount;
        $this->computeForAll();
    }
    public function updatedQrCode()
    {
        $this->add_product($this->qr_code);
        $this->reset(['qr_code']);
    }
    public function add_product($id)
    {
        $product = Item::whereHas('quantities', function ($q) {
            $q->where('warehouse_id', auth()->user()->warehouse_id);
        })->find($id);
        // dd($product);
        if (!$product) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'المنتج غير موجود']);
            return;
        }
        if ($product->allow_quantity && $product->quantity < 1) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'الكمية غير كافية']);
        } else {

            $tax_value = setting()->tax_enabled ? setting()->tax_rate : 0;
            $newArr = array_filter($this->items, function ($item) use ($product) {
                return $item['item_id'] == $product->id;
            });

            $discount = 0;
            $offer = null;
            if ($product->offer) {
                $discount = $product->sale_price * ($product->offer->rate / 100);
                $offer = $product->offer->id;
            }

            if (count($newArr) > 0) {
                $key = array_keys($newArr)[0];
                if ($product->allow_quantity && $product->quantity < $this->items[$key]['quantity']) {
                    --$this->items[$key]['quantity'];
                    $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'الكمية غير كافية']);
                } else {
                    ++$this->items[$key]['quantity'];
                    $this->computeForAll();
                }
            } else {

                $total = $product->sale_price - $discount;
                if ($product->has_tax) {
                    $tax = $product->sale_price * ($tax_value / 100);
                } else {
                    $tax = 0;
                }


                $this->items[] = [
                    'order_id' => $this->order_id,
                    'item_id' => $product->id,
                    'name' => $product->name,
                    'sale_price' => $product->sale_price,
                    //'discount' => $discount,
                    'quantity' => 1,
                    'total' => $total,
                    'tax' => $tax,
                    'warehouse_id' => auth()->user()->warehouse_id,
                ];
            }
        }
        $this->computeForAll();
    }


    public function increment($key)
    {
        $this->items[$key]['quantity']++;
        $this->computeForAll();
    }

    public function decrement($key)
    {
        $this->items[$key]['quantity']--;

        if ($this->items[$key]['quantity'] == 0) {
            $this->items[$key]['quantity']++;
        }
        $this->computeForAll();
    }

    public function delete_item($key)
    {
        unset($this->items[$key]);
        $this->computeForAll();
    }

    public function updatedDiscount()
    {
        $this->computeForAll();
    }


    protected function calculateMethods()
    {
        $total = ((float) $this->card) + ((float) $this->cash);

        if ($total > $this->total) {
            // do {
            if ($this->card != 0) {
                $this->card = 0;
            } elseif ($this->cash != 0) {
                $this->cash = 0;
            }
            // } while ($total > $this->total);
        }
        $total = ((float) $this->card) + ((float) $this->cash);

        $this->rest = ((float) $this->total) - (float) $total;
    }

    public function updatedCard()
    {
        $this->calculateMethods();

        //$this->computeForAll();
        /* if ($this->card) {
        $this->card = $this->card == "" ? 0 : $this->card;
        $this->cash = 0;
        $this->rest =  $this->total - $this->card;
        } else {
        $this->rest =  $this->total;
        } */
    }

    public function updatedCash()
    {
        $this->calculateMethods();

        /* if ($this->cash) {
        //$this->computeForAll();
        $this->cash = $this->cash == "" ? 0 : $this->cash;
        $this->card = 0;
        $this->rest =  $this->total - $this->cash;
        } else {
        $this->rest =  $this->total;
        } */
    }

    public function computeForAll()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $carry += $item['sale_price'] * $item['quantity'];
            return $carry;
        });

        $this->tax = array_reduce($this->items, function ($carry, $item) {

            $carry += $item['tax'] * $item['quantity'];

            // dd((int)sprintf("%.2f", $item['tax']));

            return number_format($carry, 2);
        });

        /*         $this->offers_discount = array_reduce($this->items, function ($carry, $item) {
        $carry += $item['discount'];
        return $carry;
        }); */

        $discount = $this->discount ? $this->discount : 0;

        $this->total = floatval($this->amount) + floatval($this->tax) - $discount;

        $this->card = $this->total;
        $this->rest = 0;

        //$this->calculateNet();

        //$this->card = ($this->total * setting('tax')) / 100 + $this->total - $discount;
    }


    /*public function calculateNet()
    {
    $this->card = $this->card == "" ? 0 : $this->card;
    $this->cash = $this->cash == "" ? 0 : $this->cash;
    $this->discount = $this->discount == "" ? 0 : $this->discount;
    $this->rest
    = $this->total
    - ($this->card + $this->cash + $this->discount);
    }*/

    public function submit($payment_method, $status = null)
    {
        if ($this->not_paid) {
            $status = 'unpaid';
        }

        $data = $this->validate([
            'items' => 'min:1',
            'amount' => 'required',
            'total' => 'required',
            'card' => 'required|numeric',
            'cash' => 'required|numeric',
        ]);

        if ($this->cash >= 0 && $this->card >= 0) {

            $status = is_null($status) ? 'paid' : 'unpaid';
            $data = [
                'employee_id' => auth()->user()->id,
                'patient_id' => $this->client_id,
                'animal_id' => $this->animal_id,
                'employee_id' => auth()->user()->id,
                'date' => $this->date,
                'tax' => $this->tax,
                'amount' => $this->amount,
                'total' => $this->total,
                'discount' => $this->discount != '' ? $this->discount : 0,
                'cash' => $this->cash,
                'card' => $this->card,
                'rest' => $this->rest,
                'status' => $status,
            ];

            if ($this->edit_mode and $this->order) {
                $this->order->items()->delete();
                foreach ($this->items as $id => $quantity) {
                    $product = Item::findOrFail($quantity['item_id']);
                } //end of foreach

                $this->order->update($data);
                $this->order->items()->createMany($this->items);

                foreach ($this->items as $id => $quantity) {

                    $product = Item::findOrFail($quantity['item_id']);
                    if ($product->quantity > 0) {
                        /* $product->update([
                            'quantity' => $product->quantity - $quantity['quantity']
                        ]); */
                    }
                } //end of foreach
                $order = $this->order;
            } else {
                $order = Order::create($data);
                $order->items()->createMany($this->items);
            }

            return redirect()->route('front.orders.show', $order->id);
            // $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم إضافة الفاتورة بنجاح']);
            // $this->reset();
            // $this->mount();
            // $this->resetAll();

            /*  if (setting('active_invoice_print')) {
            } else {
            $this->resetAll();
            } */
        } else {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => 'يوجد مشكلة في المبلغ المدفوع']);
        }
    }

    public function resetAll()
    {
        $this->reset();
        $this->mount();
    }

    public function getOrder($id)
    {
        $this->order = Order::with(['items', 'user', 'client'])->findOrFail($id);
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting()->tax_no) == 15) {
            $this->qrCode = Zatca::sellerName(setting('website_name'))
                ->vatRegistrationNumber(setting('tax_no'))
                ->timestamp($this->order->created_at)
                ->totalWithVat($this->order->total)
                ->vatTotal($this->order->tax)
                ->toQrCode($qrCodeOptions);
        }
    }

    public function mount()
    {
        // if($id!=0){
        //     $this->getOrder($id);
        // }
        $order = Order::latest('id')->first();
        $this->date = now()->format('Y-m-d');
        $this->order_id = $order ? $order->id + 1 : 1;
        $this->payment_method = 'card';
    }
    public function render(Request $request)
    {
        if ($request->id) {
            $this->getOrder($request->id);
        }

        $unpaid_orders = Order::unpaid()->get();
        /*  if(isset($this->product_id)) {
        $products = Item::when($this->product_id, function ($q) {
            $q->where('barcode', $this->product_id);
        })->get();
    } elseif(isset($this->product_name)) {
        $products = Item::when($this->product_name, function ($q) {
            $q->where('name', $this->product_name);
        })->get();
    } else {
        $products = Item::all();
    } */
        $categories = ItemCategory::get();
        $products = Item::where(function ($q) {
            if ($this->product_id) {
                $q->where('barcode', 'like', "%$this->product_id%");
            }
            if ($this->product_name) {
                $q->where('name', 'like', "%$this->product_name%");
            }
            if ($this->category_id) {
                $q->where('category_id', $this->category_id);
            }
        })->whereHas('quantities', function ($q) {
            if (!auth()->user()->isAdmin()) {
                $q->where('warehouse_id', auth()->user()->warehouse_id);
            }
        })->get();

        return view('livewire.orders.create', compact('products', 'unpaid_orders', 'categories'));
    }

    public function updatedProductId($val)
    {
        $product = Item::whereHas('quantities', function ($q) {
            $q->where('warehouse_id', auth()->user()->warehouse_id);
        })->where('barcode', $val)->first();
        if ($product) {
            $this->add_product($product->id);
            $this->reset('product_id');
        }
    }
}
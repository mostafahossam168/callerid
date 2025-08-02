<?php

namespace App\Http\Livewire\PurchaseInvoices;

use App\Models\Item;
use App\Models\ItemQuantity;
use App\Models\PurchaseInvoice;
use App\Models\Supplier;
use App\Models\Voucher;
use App\Models\Warehouse;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditPurchaseInvoices extends Component
{
    public $supplier_id, $warehouse_id, $amount, $items = [], $purchase_invoice, $tax = 0, $total = 0;

    public function rules()
    {
        return [
            'supplier_id' => 'required',
            'warehouse_id' => 'required',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'items.*.item_id' => 'required',
            'items.*.quantity' => 'required|integer',
        ];
    }

    public function mount(PurchaseInvoice $purchase_invoice)
    {
        $this->purchase_invoice = $purchase_invoice;
        $this->supplier_id = $purchase_invoice->supplier_id;
        $this->warehouse_id = $purchase_invoice->warehouse_id;
        $this->amount = $purchase_invoice->amount;
        $this->tax = $purchase_invoice->tax;
        $this->total = $purchase_invoice->total;
        $this->items = $purchase_invoice->items()->get()->toArray();
    }

    public function render()
    {
        $warehouses = Warehouse::all();
        $suppliers = Supplier::where('warehouse_id', $this->warehouse_id)->get();
        $products = Item::all();
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.purchase-invoices.form', compact('warehouses', 'suppliers', 'products'))->extends('front.layouts.front')->section('content');
    }

    public function addItem()
    {
        $this->items[] = [
            'item_id' => '',
            'quantity' => '',
            'cost_price' => '',
            'sell_price' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
    }
    
    public function calculateTotal()
    {
        $this->amount = array_reduce($this->items, function ($carry, $item) {
            $carry += doubleval($item['cost_price']) * intval($item['quantity']);
            return round($carry, 2);
        });

        if (setting()->tax_enabled) {
            $this->tax = $this->amount * (setting()->tax_rate / 100);
        }

        $this->total = $this->tax + $this->amount;
    }
    
    public function save()
    {
        $data = $this->validate();

        try {
            DB::beginTransaction();
            $this->purchase_invoice->update($data);

            $this->purchase_invoice->items()->delete();
            $this->purchase_invoice->item_quantities()->delete();
            $this->purchase_invoice->vouchers()->delete();

            $this->purchase_invoice->items()->createMany($this->items);

            foreach ($this->items as $item) {
                ItemQuantity::create([
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'type' => 'charge',
                ]);
                $product = Item::find($item['item_id']);
                $product->update(['sale_price' => $item['sell_price']]);
            }

            $voucher = Voucher::create([
                'date' => date('Y-m-d'),
                'description' => 'فاتورة مشتريات رقم ' . $this->purchase_invoice?->id . ' من المورد ' . $this->purchase_invoice->supplier?->name,
                'purchase_invoice_id' => $this->purchase_invoice->id,
            ]);

            $voucher->accounts()->createMany(
                [
                    [
                        'voucher_id' => $voucher->id,
                        'account_id' => $this->purchase_invoice->supplier?->account_id,
                        'credit' => $this->amount,
                        'debit' => 0,
                        'description' =>  $voucher->description,
                    ],
                    [
                        'voucher_id' => $voucher->id,
                        'account_id' => $this->purchase_invoice->warehouse?->account_id,
                        'credit' => 0,
                        'debit' => $this->amount,
                        'description' => $voucher->description,
                    ]
                ]

            );

            DB::commit();

            return redirect()->route('front.purchase_invoices')->with('success', __('Saved successfully'));
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}

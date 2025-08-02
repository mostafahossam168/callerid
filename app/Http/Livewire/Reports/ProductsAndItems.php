<?php

namespace App\Http\Livewire\Reports;

use App\Models\Item;
use App\Models\Product;
use Livewire\Component;
use App\Models\InvoiceItem;

class ProductsAndItems extends Component
{
    public $from, $to, $type;

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('created_at', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {

        $invoiceItems = InvoiceItem::where(function ($q) {
            $items = Item::pluck('id')->toArray();
            if ($this->type == 'items') {
                $q->whereIn('item_id', $items);
            }
            $this->between($q);
        })->get();
        $invoiceProducts = InvoiceItem::where(function ($q) {
            $products = Product::pluck('id')->toArray();
            if ($this->type == 'products') {
                $q->whereIn('product_id', $products);
            }
            $this->between($q);
        })->get();

        $data = $this->prepareAllData($invoiceItems, $invoiceProducts);
        // dd($data);
        return view('livewire.reports.products-and-items', compact('data'));
    }

    public function prepareAllData($invoiceItems = null, $invoiceProducts = null)
    {
        $result = [
            'cash' => 0,
            'card' => 0,
            'tax' => 0,
        ];
        if ($invoiceItems && ($this->type == 'items' || is_null($this->type) || $this->type == '')) {
            foreach ($invoiceItems as $item) {
                if ($item->invoice?->cash > 0) {
                    $result['cash'] += $item->price * $item->quantity;
                } elseif ($item->invoice?->card > 0) {
                    $result['card'] += $item->price * $item->quantity;
                }
                $result['tax'] += $item->tax;
            }
        }
        if ($invoiceProducts && ($this->type == 'products' || is_null($this->type) || $this->type == '')) {
            foreach ($invoiceProducts as $item) {
                if ($item->invoice?->cash > 0) {
                    $result['cash'] += $item->price * $item->quantity;
                } elseif ($item->invoice?->card > 0) {
                    $result['card'] += $item->price * $item->quantity;
                }
                $result['tax'] += $item->tax;
            }
        }
        return $result;
    }
}

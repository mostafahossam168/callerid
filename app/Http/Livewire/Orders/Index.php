<?php

namespace App\Http\Livewire\Orders;

use App\Exports\OrderExport;
use App\Exports\SupplyExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    public $filter_status, $from, $to, $searchemployee, $searchinvoiveno, $refund, $refund_status, $barcode_search;
    public $total, $totalcash, $totalcard;

    protected $paginationTheme = 'bootstrap';

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

    public function retrieved(Order $order)
    {
        $this->validate([
            'refund' => 'required|numeric',
            'refund_status' => 'required|in:creditor,debtor',
        ],[],[
            'refund' => __('admin.amount'),
            'refund_status' => __('admin.Status') ,
        ]);

        $total = 0;
        if ($this->refund_status == 'creditor') {
            $total = $order->total + $this->refund;
        } else {
            $total = $order->total - $this->refund;
        }

        $order->update([
            'total' => $total,
            'refund' => $this->refund,
            'refund_status' => $this->refund_status
        ]);
        $this->reset();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم استرجاع الفاتورة بنجاح']);
    }

    public function delete(Order $order)
    {
        $order->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم حذف الفاتورة بنجاح']);
    }

    public function render()
    {
        $all_orders = Order::all();
        $searchemployee = $this->searchemployee;
        $orders = Order::with(['user', 'client'])->where(function ($q) use ($searchemployee) {
            $this->between($q);
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
                $this->total = Order::where('status', $this->filter_status)->sum('total');
                $this->totalcash = Order::where('status', $this->filter_status)->sum('cash');
                $this->totalcard = Order::where('status', $this->filter_status)->sum('card');
            }
            if ($this->searchinvoiveno) {
                $q->where('id', 'like', '%' . $this->searchinvoiveno . '%');
            }
            if ($this->searchemployee) {
                $q->whereHas('client', function ($q) use ($searchemployee) {
                    $q->where('first_name', $searchemployee);
                });
            }

            if ($this->barcode_search) {
                $q->whereHas('items', function ($query) {
                    $query->whereHas('product', function ($queryy) {
                        $queryy->where('barcode', $this->barcode_search);
                    });
                });
                // $q->where('barcode', $searchemployee);
            }
        })->latest('id')->paginate(10);


        return view('livewire.orders.index', compact('orders', 'all_orders'));
    }

    public function export()
    {
        $searchemployee = $this->searchemployee;

        $orders = Order::with(['user', 'client'])->where(function ($q) use ($searchemployee) {
            $this->between($q);
            if ($this->filter_status) {
                $q->where('status', $this->filter_status);
                $this->total = Order::where('status', $this->filter_status)->sum('total');
                $this->totalcash = Order::where('status', $this->filter_status)->sum('cash');
                $this->totalcard = Order::where('status', $this->filter_status)->sum('card');
            }
            if ($this->searchinvoiveno) {
                $q->where('id', 'like', '%' . $this->searchinvoiveno . '%');
            }
            if ($this->searchemployee) {
                $q->whereHas('client', function ($q) use ($searchemployee) {
                    $q->where('first_name', $searchemployee);
                });
            }

            if ($this->barcode_search) {
                $q->whereHas('items', function ($query) {
                    $query->whereHas('product', function ($queryy) {
                        $queryy->where('barcode', $this->barcode_search);
                    });
                });
                // $q->where('barcode', $searchemployee);
            }
        })->get();

        return Excel::download(new OrderExport($orders), 'orders' . time() . '.xlsx');

    }
}
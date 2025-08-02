<?php

namespace App\Http\Livewire\Voucher;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\VouchersExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class index extends Component
{
    public $employee_id, $from, $to, $voucher_no, $search;
    public Collection $vouchers;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    function delete(Voucher $voucher)
    {
        $voucher->delete($voucher);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم حذف السند بنجاح']);
    }

    public function mount()
    {
        if ($year = cache('accounting_year')) {
            $this->from = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->to = Carbon::parse($year . '-12-31')->format('Y-m-d');
        }
    }

    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereBetween('date', [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where('date', '>=', $this->from);
        } elseif ($this->to) {
            $query->where('date', '<=', $this->to);
        } else {
            $query;
        }
    }

    public function export()
    {
        return Excel::download(new VouchersExport($this->vouchers), 'vouchers' . time() . '.xlsx');
    }
    public function render()
    {
        $all_vouchers = Voucher::when($this->search, function ($q) {
            $q->where('description', 'LIKE', "%$this->search%");
        })->when($this->voucher_no, function ($q) {
            $q->where('id', $this->voucher_no);
        })->when($this->employee_id, function ($q) {
            $q->where('employee_id', $this->employee_id);
        })->where(function ($q) {
            $this->between($q);
        })->whereNull('invoice_id')->latest()->paginate(15);

        $this->vouchers = Voucher::when($this->search, function ($q) {
            $q->where('description', 'LIKE', "%$this->search%");
        })->when($this->voucher_no, function ($q) {
            $q->where('id', $this->voucher_no);
        })->when($this->employee_id, function ($q) {
            $q->where('employee_id', $this->employee_id);
        })->where(function ($q) {
            $this->between($q);
        })->latest()->get();

        $users = User::whereIn('type', ['admin', 'accountant', 'recep'])->get();

        return view('livewire.voucher.index', compact('all_vouchers', 'users'));
    }
}

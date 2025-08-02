<?php

namespace App\Http\Livewire\Reports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Account;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\VoucherAccount;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReceptionRestrictionExport;

class ReceptionRestrictions extends Component
{
    public $search, $credit, $account, $from, $to, $accounts, $doctor, $doctors, $virtual_search;
    public function render()
    {
        $reviews = Voucher::whereNotNull('invoice_id')->where(function ($q) {
            if ($this->from && $this->to) {
                $q->whereBetween('date', [$this->from, $this->to]);
            } elseif ($this->from) {
                $q->whereDate('date', '>=', $this->from);
            }

            if ($this->search) {
                $q->where('id', $this->search)->orWhere('invoice_id', $this->search);
            }
            if ($this->virtual_search && !$this->search) {
                $q->where('id', $this->virtual_search);
            }
            // if ($this->credit) {
            //     $q->where('credit', $this->credit);
            // }
            if ($this->account) {
                $q->where('account_id', $this->account);
            }
            if ($this->doctor) {
                $q->whereHas('invoice', function ($query) {
                    $query->where('dr_id', $this->doctor);
                });
            }
        })->paginate(10);
        return view('livewire.reports.reception-restrictions', compact('reviews'));
    }

    public function mount()
    {
        $this->accounts = Account::all();
        $this->doctors = User::doctors()->withTrashed()->get();
        $lastVoucher  = Voucher::whereNotNull('invoice_id')->latest()->first();
        $this->virtual_search = $lastVoucher?->id;

        if ($year = cache('accounting_year')) {
            $this->from = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->to = Carbon::parse($year . '-12-31')->format('Y-m-d');
        }
    }
    public function export()
    {

        $reviews = Voucher::whereNotNull('invoice_id')->where(function ($q) {
            if ($this->from && $this->to) {
                $q->whereBetween('parent_date', [$this->from, $this->to]);
            } elseif ($this->from) {
                $q->whereDate('parent_date', '>=', $this->from);
            }

            if ($this->search) {
                $q->where('invoice_id', $this->search)->orWhereHas('voucher', function ($query) {
                    $query->where('id', $this->search);
                });
            }
            // if ($this->credit) {
            //     $q->where('credit', $this->credit);
            // }
            if ($this->account) {
                $q->where('account_id', $this->account);
            }
            if ($this->doctor) {
                $q->whereHas('invoice', function ($query) {
                    $query->where('dr_id', $this->doctor);
                });
            }
        })->paginate(10);

        return Excel::download(new ReceptionRestrictionExport($reviews), 'reception-restrictions' . time() . '.xlsx');
    }

    function delete(Voucher $voucher)
    {
        $voucher->delete($voucher);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم حذف السند بنجاح']);
    }
}

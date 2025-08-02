<?php

namespace App\Http\Livewire\Front\Reports;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Account;
use Livewire\Component;
use App\Models\VoucherAccount;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Reports\CostCenterExport;
use App\Models\CostCenter as ModelsCostCenter;

class CostCenter extends Component

{
    public $filter_start_date, $filter_end_date, $branches, $filter_branch, $filter_account, $all_accounts;
    public $from, $to; // تحديد الخصائص $from و $to

    public function mount()
    {
        $this->branches = ModelsCostCenter::latest()->get();
        $this->all_accounts = Account::all();
        if ($year = cache('accounting_year')) {
            $this->filter_start_date = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->filter_end_date = Carbon::parse($year . '-12-31')->format('Y-m-d');
        }
    }
    public function render()
    {
        // if ($this->filter_branch) {
        //     $vouchers = VoucherAccount::whereHas('voucher', function ($q) {
        //         if ($this->filter_start_date && $this->filter_end_date) {
        //             $q->whereBetween('date', [$this->filter_start_date, $this->filter_end_date]);
        //         } elseif ($this->filter_start_date) {
        //             $q->where('date', '>', $this->filter_start_date);
        //         }
        //     })->where(function ($q) {
        //         $q->where('branch_id', $this->filter_branch);
        //     })->latest()->get();
        // } else {
        //     $vouchers = [];
        // }
        $accounts = Account::latest()->where(function ($q) {
            if ($this->filter_account) {
                $q->where('id', $this->filter_account);
            }
        })->get();

        return view('livewire.front.reports.cost-center', compact('accounts'))->extends('front.layouts.front')->section('content');
    }

    public function export()
    {
        // تعيين قيمة $from و $to
        $this->from = $this->filter_start_date;
        $this->to = $this->filter_end_date;

        return Excel::download(new CostCenterExport($this->from, $this->to), time() . '.xlsx');
    }
}

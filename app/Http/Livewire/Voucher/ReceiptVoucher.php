<?php

namespace App\Livewire\Admin\Vouchers;

use App\Models\Office;
use App\Models\Voucher;
use App\Models\VoucherAccount;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ReceiptVoucher extends Component
{
    public  $office_id, $date, $description, $amount, $type, $payment_method;

    public function render()
    {
        $offices = Office::active()->get();
        return view('livewire.admin.vouchers.receipt-voucher', compact('offices'))->extends('admin.layouts.admin')->section('content');
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->type = 'receipt';
    }

    public function save()
    {
        $data = $this->validate([
            'office_id' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'amount' => 'required|numeric|gt:0',
            'type' => 'required',
            'payment_method' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $office = Office::find($this->office_id);

            $voucher = Voucher::create($data);

            if ($this->payment_method == 'cash') {
                $account_id = setting('treasury_account_id');
            } else {
                $account_id = setting('bank_account_id');
            }

            VoucherAccount::create([
                'voucher_id' => $voucher->id,
                'account_id' => $office->account_id,
                'credit' => $this->amount,
                'debit' => 0,
                'description' => $voucher->description,
            ]);

            VoucherAccount::create([
                'voucher_id' => $voucher->id,
                'account_id' => $account_id,
                'credit' => 0,
                'debit' => $this->amount,
                'description' => $voucher->description,
            ]);

            DB::commit();

            return redirect()->route('admin.vouchers.index')->with('success', 'تم حفظ البيانات بنجاح');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error', $ex->getMessage());
            return;
        }
    }
}

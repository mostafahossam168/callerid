<?php

namespace App\Http\Livewire\Voucher;

use App\Models\Account;
use App\Models\Office;
use App\Models\PaymentMethod;
use App\Models\Voucher;
use App\Models\VoucherAccount;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentVoucher extends Component
{
    public  $account_id, $date, $description, $amount, $type, $payment_method_id;

    public function render()
    {
        $accounts = Account::all();
        $payment_methods = PaymentMethod::all();
        //        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.voucher.payment-voucher', compact('accounts', 'payment_methods'))->extends('front.layouts.front')->section('content');
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->type = 'payment';
    }

    public function save()
    {
        $data = $this->validate([
            'account_id' => 'required',
            'date' => 'required|date',
            'description' => 'required',
            'amount' => 'required|numeric|gt:0',
            'type' => 'required',
            'payment_method_id' => 'required',
        ], [], [
            'description' => 'الوصف',
            'payment_method_id' => 'طريقة الصرف',
        ]);

        try {
            DB::beginTransaction();

            $voucher = Voucher::create($data);

            $payment_method = PaymentMethod::find($this->payment_method_id);

            VoucherAccount::create([
                'voucher_id' => $voucher->id,
                'account_id' => $this->account_id,
                'credit' => 0,
                'debit' => $this->amount,
                'description' => $voucher->description,
            ]);

            VoucherAccount::create([
                'voucher_id' => $voucher->id,
                'account_id' => $payment_method->account_id,
                'credit' => $this->amount,
                'debit' => 0,
                'description' => $voucher->description,
            ]);

            DB::commit();

            return redirect()->route('front.vouchers.index')->with('success', 'تم حفظ البيانات بنجاح');
        } catch (\Exception $ex) {
            DB::rollback();
            session()->flash('error', $ex->getMessage());
            return;
        }
    }
}

<?php

namespace App\Http\Livewire\Voucher;

use App\Models\Account;
use App\Models\Asset;
use App\Models\BankAccount;
use App\Models\Voucher;
use App\Models\VoucherAccount;
use Livewire\Component;

class CreateOrUpdate extends Component
{
    public $voucher, $voucher_description, $description, $date, $account_id, $debit, $credit, $totalDebit, $totalCredit;
    public $accounts = [];

    protected function rules()
    {
        return [
            'voucher_description' => ['required'],
            'accounts.*.description' => ['required'],
            'date' => ['required'],
            'accounts.*.debit' => ['nullable'],
            'accounts.*.credit' => ['nullable'],
            'accounts.*.account_id' => ['required'],
        ];
    }

    public function addRow()
    {
        $this->accounts[] = ['account_id' => $this->account_id, 'debit' => $this->debit ?? 0, 'credit' => $this->credit ?? 0, 'description' => $this->description];
        $this->computeAll();
    }

    public function computeAll()
    {
        $this->totalDebit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += $item['debit'] ? $item['debit'] : 0;
            return $carry;
        });
        $this->totalCredit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += $item['credit'] ? $item['credit'] : 0;
            return $carry;
        });
    }

    public function removeRow($key)
    {
        $this->totalDebit -= $this->accounts[$key]['debit'];
        $this->totalCredit -= $this->accounts[$key]['credit'];
        unset($this->accounts[$key]);
    }

    public function submit()
    {
        $data = $this->validate();
        $voucher = new Voucher();
        $voucher->description = $this->voucher_description;
        $voucher->date = $this->date;
        $voucher->save();
        $voucher->accounts()->createMany($this->accounts);
        return redirect()->route('front.vouchers.index');
    }

    public function mount()
    {
        $this->date = now()->format('Y-m-d');
        $this->addRow();
    }

    public function render()
    {
        $all_accounts = Account::whereNotNull('parent_id')->get();
        return view('livewire.voucher.create-or-update',  compact('all_accounts'));
    }
}

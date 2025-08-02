<?php

namespace App\Http\Livewire\BankAccounts;

use App\Models\Asset;
use App\Models\Account;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\BankAccount;

class Edit extends Component
{
    public $bank_account, $account_name, $account_number, $balance;


    protected function rules()
    {
        return [
            'account_name' => ['required'],
            'account_number' => ['required', 'numeric'],
            'balance' => ['required', 'numeric'],
        ];
    }

    public function validationAttributes()
    {
        return [
            'account_name' => __('Account name'),
            'account_number' =>  __('Account number'),
            'balance' =>  __('Balance'),
        ];
    }

    public function submit()
    {
        $data = $this->validate();

        $this->bank_account->update($data);

        return redirect()->route('front.bank-accounts.index');
    }

    public function mount($bank_account)
    {
        $this->bank_account = $bank_account;
        $this->account_name = $bank_account->account_name;
        $this->account_number = $bank_account->account_number;
        $this->balance = $bank_account->balance;
    }
}
<?php

namespace App\Http\Livewire\BankAccounts;

use App\Models\Asset;
use App\Models\Account;
use App\Models\Voucher;
use Livewire\Component;
use App\Models\BankAccount;
use App\Models\CostCenter;

class Create extends Component
{
    public  $account_name, $account_number, $balance;

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
        // dd($this->accounts,abs($this->totalCredit - $this->totalDebit));
        $data = $this->validate();


        BankAccount::create($data);


        return redirect()->route('front.bank-accounts.index');
    }




    public function mount()
    {
    }

    public function render()
    {

        return view('livewire.bank-accounts.create');
    }
}
<?php

namespace App\Http\Livewire\BankAccounts;

use App\Models\BankAccount;
use App\Models\User;
use App\Models\Voucher;
use Livewire\Component;
use Livewire\WithPagination;

class index extends Component
{
    public  $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    function delete(BankAccount $bank_account)
    {
        $bank_account->delete($bank_account);
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'تم حذف الحساب البنكي بنجاح']);
    }






    public function render()
    {
        $bank_accounts = BankAccount::when($this->search, function ($q) {
            $q->where('account_name', 'LIKE', "%$this->search%")
            ->orwhere('account_number', 'LIKE', "%$this->search%")
            ->orwhere('balance', 'LIKE', "%$this->search%");
        })->latest()->paginate(15);



        return view('livewire.bank-accounts.index', compact('bank_accounts'));
    }
}

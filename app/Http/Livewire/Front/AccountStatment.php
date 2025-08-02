<?php

namespace App\Http\Livewire\Front;

use Carbon\Carbon;
use App\Models\Account;
use Livewire\Component;
use App\Exports\ReviewsExport;
use App\Models\VoucherAccount;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AccountStatementExport;

class AccountStatment extends Component
{
    public $filter_start_date, $filter_end_date, $accounts, $filter_account, $statements, $array_of_accounts = [];
    public function mount()
    {
        $this->accounts = Account::latest()->get();

        if ($year = cache('accounting_year')) {
            $this->filter_start_date = Carbon::parse($year . '-01-01')->format('Y-m-d');
            $this->filter_end_date = Carbon::parse($year . '-12-31')->format('Y-m-d');
        }
    }

    public function export()
    {

        return Excel::download(new AccountStatementExport($this->statements), 'statements' . time() . '.xlsx');
    }

    public function render()
    {
        if ($this->filter_account) {
            $this->array_of_accounts = [];
            $account = Account::find($this->filter_account);
            if ($account->kids()->count() > 0) {
                foreach ($account->kids as $key => $kid) {
                    $this->array_of_accounts[] += $kid->id;
                    if ($kid->subAssets->isNotEmpty()) {
                        $this->renderNestedAccounts($kid->subAssets);
                    }
                }
            } else {
                $this->array_of_accounts[] += $account->id;
            }
            $vouchers = VoucherAccount::whereHas('voucher', function ($q) {
                if ($this->filter_start_date && $this->filter_end_date) {
                    $q->whereBetween('date', [$this->filter_start_date, $this->filter_end_date]);
                } elseif ($this->filter_start_date) {
                    $q->where('date', '>', $this->filter_start_date);
                }
            })->where(function ($q) {
                $q->whereIn('account_id', $this->array_of_accounts);
            })->get();
        } else {
            $vouchers = [];
        }
        $this->statements = $vouchers;
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.front.account-statment', compact('vouchers'));
    }

    public function renderNestedAccounts($assets)
    {
        foreach ($assets as $asset) {
            $this->array_of_accounts[] += $asset->id;
            if ($asset->subAssets->isNotEmpty()) {
                $this->renderNestedAccounts($asset->subAssets);
            }
        }
    }
}

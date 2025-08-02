<?php

namespace App\Http\Livewire\Voucher;

use App\Models\User;
use App\Models\Asset;
use App\Models\Account;
use App\Models\CostCenter;
use App\Models\Voucher;
use Livewire\Component;

class Edit extends Component
{
    public $voucher, $name, $description, $date, $account_id, $debit, $credit, $totalDebit, $totalCredit, $voucher_no, $cost_center_id;
    public $accounts = [];

    protected function rules()
    {
        return [
            'date' => ['required'],
            'description' => ['required'],
            'accounts.*.debit' => ['nullable'],
            'accounts.*.credit' => ['nullable'],
            // 'accounts.*.debit2' => ['nullable'],
            // 'accounts.*.credit2' => ['nullable'],
            'accounts.*.description' => ['required'],
            // 'accounts.*.description2' => ['required'],
            'accounts.*.cost_center_id' => ['nullable'],
            'accounts.*.account_id' => ['required'],
            // 'accounts.*.account_id2' => ['required'],
            // 'accounts.*.account_key' => ['nullable'],
            'accounts.*.selected_account' => ['nullable'],
        ];
    }

    public function addRow()
    {
        $this->accounts[] = [
            'account_id' => '',
            'cost_center_id' => '',
            'debit' => 0,
            'credit' => 0,
            'description' => '',
            'selected_account' => null,
        ];
        $this->accounts[] = [
            'account_id' => '',
            'cost_center_id' => '',
            'debit' => 0,
            'credit' => 0,
            'description' => '',
            'selected_account' => null,
        ];

        $this->computeAll();
    }

    // public function updatedVoucherDescription()
    // {
    //     $this->accounts[0]['description'] = '';
    // }

    public function computeAll()
    {
        $this->totalDebit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += doubleval($item['debit'] ? $item['debit'] : 0);
            return $carry;
        });
        $this->totalCredit = array_reduce($this->accounts, function ($carry, $item) {
            $carry += doubleval($item['credit'] ? $item['credit'] : 0);
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
        // dd($this->accounts);
        $data = $this->validate();

        // $voucher->description = $this->voucher_description;
        $this->voucher->date = $this->date;
        $this->voucher->voucher_no = $this->voucher_no;
        $this->voucher->employee_id = auth()->user()->id;
        $this->voucher->description = $this->description;
        $this->voucher->save();
        // dd($this->fixEmptyValuesToZero($this->accounts));
        $this->voucher->accounts()->delete();
        $this->voucher->accounts()->createMany($this->fixEmptyValuesToZero($this->accounts));
        return redirect()->route('front.vouchers.index');
    }


    public function getAccounts($index, $value)
    {
        if ($value) {
            $this->accounts[$index]['all_accounts'] = Account::where('parent_id', $value)->get();
        } else {
            $this->accounts[$index]['all_accounts'] = [];
        }
    }
    public function get_account($key)
    {

        if ($acc = Account::where('id', $this->accounts[$key]['account_key'])->first()) {
            $this->accounts[$key]['selected_account'] = $acc?->name ?? null;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم جلب بيانات الحساب بنجاح')]);
        } else {
            $this->accounts[$key]['selected_account'] =  null;
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
        // $this->accounts[$key]['account_key'] = null;
    }
    public function mount(Voucher $voucher)
    {
        $this->voucher = $voucher;
        $this->accounts = $voucher->accounts()->get()->toArray();
        $this->date = $voucher->date;
        $this->description = $voucher->description;
        $this->voucher_no = $voucher->voucher_no;
        $this->updatedAccounts(null);
        $this->computeAll();
    }
    public function updatedAccounts($value = null)
    {
        foreach ($this->accounts as $key => $account) {
            if ($acc = Account::where('id', $this->accounts[$key]['account_id'])->first()) {
                $this->accounts[$key]['selected_account'] = $acc?->name ?? null;
            } else {
                $this->accounts[$key]['selected_account'] =  null;
            }
        }
    }
    public function render()
    {
        $all_accounts = Account::query()->get();
        $cost_centers = CostCenter::all();
        $users = User::where('type', '!=', 'admin')->pluck('name', 'id');
        $this->dispatchBrowserEvent('pharaonic.select2.init');
        return view('livewire.voucher.edit', compact('all_accounts', 'users', 'cost_centers'));
    }

    private function fixEmptyValuesToZero($accounts)
    {
        foreach ($accounts as $key => $account) {
            $accounts[$key]['debit'] =  !empty($account['debit']) ? $account['debit'] : 0;
            $accounts[$key]['credit'] =  !empty($account['credit']) ? $account['credit'] : 0;
            $accounts[$key]['cost_center_id'] =  !empty($account['cost_center_id']) ? $account['cost_center_id'] : null;
            // $accounts[$key]['debit2'] =  !empty($account['debit2']) ? $account['debit2'] : 0;
            // $accounts[$key]['credit2'] =  !empty($account['credit2']) ? $account['credit2'] : 0;
            unset($accounts[$key]['selected_account']);
        }
        return $accounts;
    }
}

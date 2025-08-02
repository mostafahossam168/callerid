<?php

namespace App\Http\Livewire\Voucher;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Account;
use App\Models\CostCenter;
use App\Models\Voucher;
use Livewire\Component;

class Create extends Component
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
            'accounts.*.description' => ['required'],
            'accounts.*.account_id' => ['required'],
            'accounts.*.selected_account' => ['nullable'],
            'accounts.*.cost_center_id' => ['nullable'],
            'accounts.*.parent_date' => ['required']
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
            'parent_date' => $this->date,
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
        $data = $this->validate();

        $voucher = new Voucher();
        // $voucher->description = $this->voucher_description;
        $voucher->date = $this->date;
        $voucher->voucher_no = $this->voucher_no;
        $voucher->employee_id = auth()->user()->id;
        $voucher->description = $this->description;
        $voucher->save();
        // dd($this->fixEmptyValuesToZero($this->accounts));
        $voucher->accounts()->createMany($this->fixEmptyValuesToZero($this->accounts));
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

        if ($acc = Account::where('id', $this->accounts[$key]['account_id'])->first()) {
            $this->accounts[$key]['selected_account'] = $acc?->name ?? null;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('تم جلب بيانات الحساب بنجاح')]);
        } else {
            $this->accounts[$key]['selected_account'] =  null;
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('No results found')]);
        }
        // $this->accounts[$key]['account_key'] = null;
    }
    public function mount()
    {
        $year = cache('accounting_year');
        $this->date = $year ? Carbon::parse($year . '-12-31')->format('Y-m-d') : now()->format('Y-m-d');
        $last_number = Voucher::latest()->first();
        $this->voucher_no = $last_number?->voucher_no + 1;
        $this->addRow();
    }
    public function updatedAccounts($value)
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
        return view('livewire.voucher.create', compact('all_accounts', 'users', 'cost_centers'));
    }

    private function fixEmptyValuesToZero($accounts)
    {
        foreach ($accounts as $key => $account) {
            $accounts[$key]['debit'] =  !empty($account['debit']) ? $account['debit'] : 0;
            $accounts[$key]['credit'] =  !empty($account['credit']) ? $account['credit'] : 0;
            $accounts[$key]['cost_center_id'] =  !empty($account['cost_center_id']) ? $account['cost_center_id'] : null;
            $accounts[$key]['parent_date'] = $this->date;
            // $accounts[$key]['credit2'] =  !empty($account['credit2']) ? $account['credit2'] : 0;
            unset($accounts[$key]['selected_account']);
        }
        return $accounts;
    }
}

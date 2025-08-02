<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Setting;
use Livewire\Component;

class AccountingDepartments extends Component
{
    public $defaults = [
        // 'taby' => null,
        // 'bonds' => null,
        // 'tamara' => null,
        // 'expenses' => null,
        // 'invoices' => null,
        // 'purchases' => null,
        // 'partily_paid' => null,
        'cash' => null,
        'card' => null,
        'bank' => null,
        'unpaid' => null,
        'tax' => null,
    ], $departments = [], $accounts;
    public function mount()
    {
        $this->accounts = Account::whereNull('doctor_id')->get();
        // if (!isset($this->dipartment['tax'])) {
        //     $this->departments = $this->defaults;
        // }
    }
    public function render()
    {
        $setting = Setting::first();
        $this->departments = $setting->accounting_departments ? json_decode($setting->accounting_departments, true) : $this->defaults;
        // if (!isset($this->dipartment['tax'])) {
        //     $this->departments['tax'] = null;
        // }
        return view('livewire.accounting-departments');
    }

    public function submit()
    {
        $setting = Setting::first();
        $setting->update(['accounting_departments' => json_encode($this->departments)]);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم حفظ الاقسام بنجاح']);
    }
}

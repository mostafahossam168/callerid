<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Branch;
use App\Models\Account;
use Livewire\Component;
use App\Traits\livewireResource;

class Accounts extends Component
{
    use livewireResource;
    public $name, $parent_id, $cost, $depreciable = 0, $filter_id, $doctor_id;
    public function rules()
    {
        return [
            'name' => 'required',
            'parent_id' => 'nullable',
            'cost' => 'nullable',
            'depreciable' => 'nullable',
            'doctor_id' => 'nullable'
        ];
    }
    public function render()
    {
        $accounts = Account::withCount(['kids'])->where(function ($q) {
            if ($this->filter_id) {
                $q->where('parent_id', $this->filter_id);
            } else {
                $q->whereNull('parent_id');
            }
            if (auth()->user()->branch_id) {
                $q->where('branch_id', auth()->user()->branch_id);
            }
        })->get();
        $parentAccounts = Account::with(['kids'])->where(function ($q) {
            if (auth()->user()->branch_id) {
                $q->where('branch_id', auth()->user()->branch_id);
            }
        })->get();
        $parents = Account::whereNull('parent_id')->where(function ($q) {
            if (auth()->user()->branch_id) {
                $q->where('branch_id', auth()->user()->branch_id);
            }
        })->with(['kids'])->get();
        $doctors = User::doctors()->get();
        return view('livewire.accounts', compact('accounts', 'parentAccounts', 'parents', 'doctors'))->extends('front.layouts.front')->section('content');
    }

    public function beforeDelete($model)
    {
        // dd($model->vouchersAccounts()->count());
        if ($model->vouchersAccounts()->count()) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error',  'message' => 'لا يمكن حذف حساب بداخلة عمليات برجاء حذف العمليات اولا قبل الحذف']);
            return true;
        }
    }

    public function beforeSubmit()
    {
        $this->data['doctor_id'] = isset($this->doctor_id) && !empty($this->doctor_id) ? $this->doctor_id : null;
    }
}

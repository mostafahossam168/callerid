<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Supplier;

class SupplierObserver
{
    public function created(Supplier $supplier)
    {
        if ($supplier->warehouse_id == 1) {
            $parent_account = Account::where('id', 37)->first();
        } elseif ($supplier->warehouse_id == 2) {
            $parent_account = Account::where('id', 36)->first();
        } else {
            $parent_account = Account::where('id', 35)->first();
        }
        $account = Account::create([
            'name' => $supplier->name,
            'parent_id' => $parent_account?->id,
        ]);

        $supplier->update(['account_id' => $account->id]);
    }

    public function updated(Supplier $supplier)
    {
        if ($supplier->type == 'clinic') {
            $parent_account = Account::where('id', 35)->first();
        } elseif ($supplier->type == 'shop') {
            $parent_account = Account::where('id', 36)->first();
        } else {
            $parent_account = Account::where('id', 37)->first();
        }

        $supplier->account->update(['name' => $supplier->name, 'parent_id' => $parent_account?->id]);
    }

    public function deleted(Supplier $supplier)
    {
        $supplier->account()->delete();
    }
}
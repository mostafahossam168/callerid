<?php

namespace App\Observers;

use App\Models\Account;
use App\Models\Supplier;
use App\Models\Warehouse;

class WarehouseObserver
{
    public function created(Warehouse $warehouse)
    {
        $parent_account = Account::where('id', 16)->first();

        $account = Account::create([
            'name' => $warehouse->name,
            'parent_id' => $parent_account->id,
        ]);

        $warehouse->update(['account_id' => $account->id]);
    }

    public function updated(Warehouse $warehouse)
    {
        $parent_account = Account::where('id', 16)->first();

        $warehouse->account->update(['name' => $warehouse->name, 'parent_id' => $parent_account->id]);
    }

    public function deleted(Warehouse $warehouse)
    {
        $warehouse->account()->delete();
    }
}

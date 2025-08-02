<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountReview extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // public function parentCalculates()
    // {
    //     if (is_null($this->parent_id)) {
    //         return [
    //             'debit_opening_balance' => $this->kidsDebitOpeningBalance(),
    //             // 'opening_credit_balance' => $this->account()->kids()->sum('debit_opening_balance'),
    //         ];
    //     }
    // }

    // public function kidsDebitOpeningBalance()
    // {
    //     $data = $this->account->reviews()->get();
    //     $result = 0;
    //     $result += $this->account->debit_opening_balance;
    //     foreach ($data as $item) {
    //         $result += $item->debit_opening_balance;
    //         $result += $item->kids()->sum('debit_opening_balance');
    //     }
    //     return $result;
    // }
}

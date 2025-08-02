<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VoucherAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_id', 'account_id', 'debit', 'credit', 'description', 'cost_center_id', 'user_id', 'parent_date', 'invoice_id', 'is_retrieved',
    ];

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function account2()
    {
        return $this->belongsTo(Account::class, 'account_id2');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    // public function costCenter()
    // {
    //     return $this->belongsTo(CostCenter::class, 'cost_center_id');
    // }
    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}

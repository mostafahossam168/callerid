<?php

namespace App\Models;

use App\Traits\EmployeeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory, EmployeeTrait;

    protected $fillable = [
        'voucher_no', 'date', 'description', 'employee_id', 'last_update', 'invoice_id', 'purchase_invoice_id', 'type'
    ];

    public function accounts()
    {
        return $this->hasMany(VoucherAccount::class);
    }

    public function getCreditAttribute()
    {
        return $this->accounts->sum('credit') + $this->accounts->sum('credit2');
    }

    public function getDebitAttribute()
    {
        return $this->accounts->sum('debit') + $this->accounts->sum('debit2');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id')->withTrashed();
    }
}

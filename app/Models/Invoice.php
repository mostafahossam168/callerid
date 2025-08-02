<?php

namespace App\Models;

use Carbon\Carbon;
use Prgayman\Zatca\Facades\Zatca;
use Illuminate\Database\Eloquent\Model;
use Prgayman\Zatca\Utilis\QrCodeOptions;

// Optional
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_number', 'category_id', 'bank', 'pharmacy_prescription_id', 'animal_id', 'patient_id', 'paid_tax', 'paid_without_tax', 'employee_id', 'total', 'discount', 'tax', 'status', 'amount', 'cash', 'card', 'rest', 'notes', 'dr_id', 'department_id', 'offers_discount', 'using_points', 'entry_date', 'departure_date', 'is_lab', 'lab_user_id'];

    protected $appends = ['paid', 'num_of_days'];

    //    scope pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'Paid');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('status', 'Unpaid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'overdue');
    }

    public function scopeDue($query)
    {
        return $query->where('status', 'due');
    }
    public function scopeLab($query)
    {
        return $query->where('is_lab', 1);
    }

    //     FIXME :: dr not mean doctor and employee is doctor when doctor creating invoice
    public function dr()
    {
        return $this->belongsTo(User::class, 'dr_id')->withTrashed();
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id')->withTrashed();
    }

    public function lab_user()
    {
        return $this->belongsTo(User::class, 'lab_user_id')->withTrashed();
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function products()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function invoice_products()
    {
        return $this->hasMany(InvoiceItem::class)->whereNotNull('product_id');
    }

    public function item_products()
    {
        return $this->hasMany(InvoiceItem::class)->whereNotNull('item_id');
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getAmountAttribute()
    {
        return round($this->attributes['amount'], 2);
    }

    public function getTotalAttribute()
    {
        return round($this->attributes['total'], 2);
    }

    public function getTaxAttribute()
    {
        return round($this->attributes['tax'], 2);
    }

    public function getCashAttribute()
    {
        return round($this->attributes['cash'], 2);
    }

    public function getCardAttribute()
    {
        return round($this->attributes['card'], 2);
    }

    public function getPaidAttribute()
    {
        return round($this->card + $this->cash + $this->bank, 2);
    }

    public function bonds()
    {
        return $this->hasMany(InvoiceBond::class, 'invoice_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function animals()
    {
        return $this->belongsToMany(Animal::class, 'invoice_animals');
    }

    public function qr()
    {
        $qrCodeOptions = new QrCodeOptions();
        $qrCodeOptions->format('svg');
        $qrCodeOptions->backgroundColor(255, 255, 255);
        $qrCodeOptions->color(0, 0, 0);
        $qrCodeOptions->size(125);
        $qrCodeOptions->margin(0);
        $qrCodeOptions->style('square', 0.5);
        $qrCodeOptions->eye('square');
        if (strlen(setting()->tax_no) == 15) {
            $qr = Zatca::sellerName(setting()->site_name)
                ->vatRegistrationNumber(setting()->tax_no)
                ->timestamp($this->created_at)
                ->totalWithVat($this->total)
                ->vatTotal($this->tax)
                ->toQrCode($qrCodeOptions);
            return $qr;
        }
    }

    public function getNumOfDaysAttribute()
    {
        return Carbon::parse($this->departure_date)->diffInDays(Carbon::parse($this->entry_date));
    }
}

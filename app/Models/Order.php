<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prgayman\Zatca\Facades\Zatca;
use Prgayman\Zatca\Utilis\QrCodeOptions;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeUnpaid($q)
    {
        return $q->where('status', 'unpaid');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id')->withTrashed();
    }
    public function client()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getPaidAttribute()
    {
        return $this->cash + $this->card;
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
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    use HasFactory;
    protected $fillable=['offer_id','patient_id','invoice_id','content'];
    public function offer(){
        return $this->belongsTo(PointOffer::class,'offer_id');
    }
    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
    public function invoice(){
        return $this->belongsTo(Invoice::class,'invoice_id');
    }

    public static function store($content,$patient_id,$invoice_id=null,$offer_id=null){
        Self::create(compact('offer_id','patient_id','invoice_id','content'));
    }
}

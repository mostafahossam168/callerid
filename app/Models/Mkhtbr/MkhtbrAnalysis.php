<?php

namespace App\Models\Mkhtbr;

use App\Models\Mkhtbr\AnalysisItem;
use App\Models\Animal;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MkhtbrAnalysis extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['hijri_date'];

    public function owner()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function items()
    {
        return $this->hasMany(AnalysisItem::class, 'mkhtbr_analysis_id');
    }

    public function getHijriDateAttribute()
    {

        return Carbon::parse($this->date)->isoFormat('YYYY-MM-DD');
    }
}

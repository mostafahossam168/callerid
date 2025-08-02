<?php

namespace App\Models\Mkhtbr;

use App\Models\Mkhtbr\AnalysisDepartment;
use App\Models\Strain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'analysis_department_id', 'strain_id', 'reference_range', 'min_range', 'max_range', 'range_type', 'sort'];
    protected $appends = ['range'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function analysis_department()
    {
        return $this->belongsTo(AnalysisDepartment::class);
    }

    public function breed()
    {
        return $this->belongsTo(Strain::class,'strain_id');
    }

    public function getRangeAttribute()
    {
        $range = '';
        if ($this->reference_range) {
            $range = $this->reference_range;
        } elseif ($this->min_range && $this->max_range) {
            $range = $this->min_range . ' - ' . $this->max_range;
        }
        return $range;
    }
}

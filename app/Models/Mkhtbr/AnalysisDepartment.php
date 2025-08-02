<?php

namespace App\Models\Mkhtbr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisDepartment extends Model
{

    protected $guarded = [];
    protected $appends = ['range'];

    public function main()
    {
        return $this->belongsTo(self::class, 'parent');
    }
    public function children()
    {
        return $this->hasMany(self::class, 'parent');
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

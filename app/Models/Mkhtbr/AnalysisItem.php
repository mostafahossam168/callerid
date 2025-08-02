<?php

namespace App\Models\Mkhtbr;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function analysis()
    {
        return $this->belongsTo(MkhtbrAnalysis::class, 'analysis_id');
    }

    public function department()
    {
        return $this->belongsTo(AnalysisDepartment::class, 'department_id');
    }
}

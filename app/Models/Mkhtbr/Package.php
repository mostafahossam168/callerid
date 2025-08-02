<?php

namespace App\Models\Mkhtbr;

use App\Models\Strain;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_urine_analysis','strain_id'];

    public function package_departments()
    {
        return $this->hasMany(PackageDepartment::class);
    }

    public function analyses()
    {
        return $this->hasMany(MkhtbrAnalysis::class);
    }

    public function breed()
    {
        return $this->belongsTo(Strain::class,'strain_id');
    }
}

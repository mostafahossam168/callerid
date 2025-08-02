<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Analysis;
use App\Models\Mkhtbr\AnalysisDepartment;
use App\Models\Mkhtbr\MkhtbrAnalysis;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function showExternal($hash_code)
    {
        $analysis = MkhtbrAnalysis::where('hash_code', $hash_code)->first();

        $departments = AnalysisDepartment::whereNull('parent')->get();

        return view('front.analysis.pdf', compact('analysis', 'departments'));
    }
}

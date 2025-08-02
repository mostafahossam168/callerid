<?php

namespace App\Http\Controllers\Front;

use App\Models\Diagnose;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use AhmedAlmory\JodaResources\JodaResource;

class DiagnoseController extends Controller
{
    use JodaResource;
    public function query($query)
    {
        return $query->with(['appoint', 'dr'])->latest()->paginate(10);
    }
    public function show(Diagnose $diagnose)
    {

        return view('front.diagnoses.show', compact('diagnose'));
    }
    public function edit(Diagnose $diagnose)
    {
        return view('front.diagnoses.edit', compact('diagnose'));
    }

    public function update(Request $request, Diagnose $diagnose)
    {
        $data = $request->validate([
            'clinical_examination' => 'nullable',
            'temperature_rate' => 'nullable',
            'age' => 'nullable',
            'weight' => 'nullable',
            'breathing_rate' => 'nullable',
            'heart_rate' => 'nullable',
            'current_symptoms' => 'nullable',
            'pharmaceutical' => 'nullable',
            'treatment_plan' => 'nullable',
            'treatment' => 'nullable',
            'next_visit' => 'nullable'
        ]);
        $diagnose->update($data);
        return redirect()->route(auth()->user()->type == 'admin' ? 'front.diagnoses.index' : 'doctor.interface')->with('success', 'تم التعديل بنجاح');
    }
}

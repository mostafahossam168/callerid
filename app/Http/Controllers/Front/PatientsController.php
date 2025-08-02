<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Animal;
use App\Models\Strain;
use App\Models\Country;
use App\Models\Patient;
use App\Models\Category;
use App\Exports\Exports2;
use App\Models\Department;
use App\Models\Relationship;
use Illuminate\Http\Request;
use App\Exports\PatientsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Patient::with(['country', 'user'])->latest()->paginate(10);
        return view('front.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('front.patients.show', compact('patient'));
    }

    public function patientFile(Patient $patient)
    {
        return view('front.patients.patientFile', compact('patient'));
    }
    public function edit(Patient $patient)
    {
        return view('front.patients.edit', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
    }


    public function export()
    {
        return Excel::download(new PatientsExport, 'patients' . time() . '.xlsx');
    }
    public function insurance()
    {
        return Excel::download(new Exports2, 'insurances' . time() . '.xlsx');
    }


    public function exportPatients()
    {
        return view('front.patients.export');
    }

    public function exportInsurances()
    {
        // dd('lll');
        return view('front.patients.export2');
    }



    public function editAnimal(Animal  $animal)
    {

        $categories = Category::all();
        $strains = Strain::all();
        return view('front.animals.edit-animal', compact('animal', 'categories', 'strains'));
    }

    public function updateAnimal(Request $request, Animal $animal)
    {

        $validated = $request->validate([
            'name' => 'nullable',
            'category_id' => 'required',
            'gender' => 'nullable',
            'age' => 'nullable',
            // 'breed_type' => 'nullable',
            'strain_id' => 'nullable',
            'number_sim' => 'nullable'
        ]);

        $animal->update($validated);

        return redirect()->back()->with('success', __('Successfully updated'));
    }

    public function animals(Patient $patient)
    {
        $patient = $patient->load('animals', 'department');
        if (auth()->user()->type != 'dr') {
            return view('front.animals.patient', compact('patient'));
        } else {
            return view('front.animals.dr-patient', compact('patient'));
        }
    }

    public function animal(Animal $animal)
    {
        return view('front.animals.show', compact('animal'));
    }

    public function add_item()
    {
        $main_categories = Category::get();
        // return  view('admin.strains.create',compact('main_categories'));
        return view('front.animals.add-item', compact('main_categories'));
    }

    public function save_item(Request $request)
    {
        // dd($request->all());
        // $main_categories=Category::get();
        // // return  view('admin.strains.create',compact('main_categories'));
        // return view('front.animals.add-item',compact('main_categories'));

        $data = $request->validate([
            'name' => ['required'],
            'category_id' => ['required', 'exists:categories,id'],
        ], [], [
            'name' => __('name'),
            'category_id' => __('category_id'),
        ]);
        Strain::create($data);
        return redirect()->route('front.patients.index')->with('success', __('Successfully added'));
        // return back()->with('success', __('Successfully added'));
    }
}
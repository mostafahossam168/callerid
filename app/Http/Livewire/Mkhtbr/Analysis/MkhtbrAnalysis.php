<?php

namespace App\Http\Livewire\Mkhtbr\Analysis;

use App\Models\Animal;
use App\Models\Mkhtbr\Package;
use App\Models\Patient;
use App\Models\Strain;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Traits\livewireResource;
use App\Models\Mkhtbr\PackageDepartment;
use App\Models\Mkhtbr\AnalysisDepartment;
use App\Models\Mkhtbr\MkhtbrAnalysis as ModelsAnalysis;

class MkhtbrAnalysis extends Component
{
    public $patient_id, $animal_id, $date, $babeosis, $recmondations,
        $animals = [], $items = [], $analysis, $key, $package_id, $strain_id, $packages = [], $lab_id;
    public $selectedPackage;
    public $selectedOwner, $selectedAnimal;
    public $searchTerm = '';
    public $showDropdown = false;

    use livewireResource;

    protected $queryString = ['screen'];

    protected function rules()
    {
        return [
            'patient_id' => 'required',
            'animal_id' => 'required',
            'package_id' => 'required',
            'strain_id' => 'required',
            'date' => 'required|date',
            //'babeosis' => 'nullable',
            'recmondations' => 'nullable',
            'lab_id' => 'required'
        ];
    }

    public function render()
    {
        $owners = Patient::where('first_name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('phone', 'like', '%' . $this->searchTerm . '%')
            ->get();
        $packages = Package::get(['id', 'name']);

        $analyses = ModelsAnalysis::when(request('patient_id'), function ($q) {
            $q->where('patient_id', request('patient_id'));
        })->when(request('animal_id'), function ($q) {
            $q->where('animal_id', request('animal_id'));
        })->when(request('package_id'), function ($q) {
            $q->where('package_id', request('package_id'));
        })->when($this->key, function ($q) {
            $q->where(function ($q) {
                $q->whereHas('animal', function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->key . '%');
                });
            })->orWhere(function ($q) {
                $q->whereHas('owner', function ($q) {
                    $q->where('name', 'LIKE', '%' . $this->key . '%');
                });
            });
        })->with(['owner', 'animal'])->latest()->paginate(10);
        $breeds = Strain::all();
        return view('livewire.mkhtbr.analysis.analysis', compact('analyses', 'owners', 'packages', 'breeds'));
    }

    public function mount($id=null)
    {
        $this->model = 'App\Models\Mkhtbr\MkhtbrAnalysis';
        $this->date = date('Y-m-d');
        if ($id){
            $this->obj =ModelsAnalysis::find($id);
            $array = array_keys($this->rules());
            foreach ($array as $key) {
                $this->$key = $this->obj->$key;
            }
        }
        if (request('patient_id')) {
            $this->patient_id = request('patient_id');
            $this->updatedOwnerId();
            $this->selectOwner($this->selectedOwner->id, $this->selectedOwner->name);
        }
    }

    public function updatedPatientId()
    {
        if ($this->patient_id) {
            $this->selectedOwner = Patient::find($this->patient_id);
            $this->animals = $this->selectedOwner->animals;
        } else {
            $this->animals = [];
        }
        $this->showDropdown = false;
    }

    public function updatedStrainId()
    {
        if ($this->strain_id) {
            $this->packages = Package::where('strain_id', $this->strain_id)->get();
        } else {
            $this->packages = [];
        }
    }

    public function updatedSearchTerm()
    {
        $this->showDropdown = true;
    }

    public function selectOwner($ownerId, $ownerName)
    {
        $this->patient_id = $ownerId;
        $this->searchTerm = $ownerName;
        $this->showDropdown = false;
        $this->updatedOwnerId();
    }

    public function updatedAnimalId($val)
    {
        if ($val) {
            $this->selectedAnimal = Animal::find($val);
        }
    }

    public function updatedPackageId()
    {
        $this->items = [];
        if ($this->package_id == 'all') {
            $departments = AnalysisDepartment::whereNotIn('parent', [1, 2])->whereNotNull('parent')->get();
            foreach ($departments as $key => $department) {
                if ($department->status) {
                    $this->items[] = [
                        'department_id' => $department->id,
                        'result' => '',
                        'range' => $department->range,
                        'unit' => $department->unit,
                        'name_ar' => $department->name_ar,
                        'name_en' => $department->name_en,
                    ];
                }
            }
        } else {
            $departments = PackageDepartment::where('package_id', $this->package_id)->orderBy('sort')->get();
            $this->selectedPackage = Package::find($this->package_id);
            foreach ($departments as $key => $department) {
                $this->items[] = [
                    'department_id' => $department->analysis_department_id,
                    'result' => '',
                    'range' => $department->range,
                    'unit' => $department->range ? $department->analysis_department->unit : '',
                    'name_ar' => $department->analysis_department->name_ar,
                    'name_en' => $department->analysis_department->name_en,
                ];
            }
        }
    }

    public function beforeSubmit()
    {
        $this->data['package_id'] = $this->data['package_id'] != 'all' ? $this->data['package_id'] : null;
        $this->data['strain_id'] = $this->data['strain_id'] != 'all' ? $this->data['strain_id'] : null;
    }
    public function afterCreate()
    {
        if ($this->selectedPackage?->is_urine_analysis) {
            $this->obj->items()->createMany(collect($this->items)->flatten(1));
        } else {
            $this->obj->items()->createMany($this->items);
        }
        $this->obj->update(['hash_code' => Str::random(50)]);
        $this->mount();
    }

    public function afterUpdate()
    {
        $this->obj->items()->delete();
        $this->obj->items()->createMany($this->items);
        $this->mount();
    }

    public function whileEditing()
    {
        $this->updatedOwnerId();
        $this->updatedPackageId();
        $this->updatedBreedId();
        $this->items = [];
        $this->selectedPackage = Package::find($this->obj?->package_id);

        foreach ($this->obj->items as $key => $item) {
            if ($item->department->status) {
                if ($this->selectedPackage?->is_urine_analysis) {
                    $this->items[$item->department->key][] = [
                        'department_id' => $item->department_id,
                        'result' => $item->result,
                        'range' => $item->range,
                        'unit' => $item->unit,
                        'name_ar' => $item->name_ar,
                        'name_en' => $item->name_en,
                        'reference_range' => $item->department->reference_range,
                    ];
                } else {
                    $this->items[] = [
                        'department_id' => $item->department_id,
                        'result' => $item->result,
                        'range' => $item->range,
                        'unit' => $item->unit,
                        'name_ar' => $item->name_ar,
                        'name_en' => $item->name_en,
                    ];
                }
            }
        }
    }

    public function analysisId($id)
    {
        $this->analysis = ModelsAnalysis::find($id);
    }

    public function delete()
    {
        $this->analysis->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الحذف بنجاح']);
    }
}

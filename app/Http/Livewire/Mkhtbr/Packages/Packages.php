<?php

namespace App\Http\Livewire\Mkhtbr\Packages;

use App\Models\Mkhtbr\AnalysisDepartment;
use App\Models\Mkhtbr\Package;
use App\Models\Strain;
use App\Traits\livewireResource;
use Livewire\Component;

class Packages extends Component
{
    public $name, $strain_id, $package_data, $departments = [];

    use livewireResource;

    public function rules()
    {
        return [
            'name' => 'required',
            'strain_id' => 'required|exists:strains,id',
            'departments' => 'required',
        ];
    }

    public function render()
    {
        $packages = Package::paginate(10);
        $analysis_departments = AnalysisDepartment::all()->filter(function ($dep) {
            return $dep->range != '';
        });
        $breeds = Strain::all();
        return view('livewire.mkhtbr.packages.packages', compact('analysis_departments', 'packages', 'breeds'));
    }

    public function mount()
    {
        $this->addItem();
    }

    public function back()
    {
        $this->reset();
        $this->screen = 'index';
        $this->addItem();
    }

    public function setModelName()
    {
        $this->model = Package::class;
    }
    public function whileEditing()
    {
        $this->departments = $this->obj->package_departments()->orderBy('analysis_department_id')->get()->toArray();
    }

    public function copy(Package $package)
    {
        $this->name = $package->name;
        $this->screen = 'copy';

        $this->departments = $package->package_departments()->orderBy('analysis_department_id')->get()->toArray();
    }

    public function afterSubmit()
    {
        $data = $this->validate([
            'departments.*.analysis_department_id' => 'nullable|exists:analysis_departments,id',
            'departments.*.min_range' => 'nullable|numeric',
            'departments.*.max_range' => 'nullable|numeric',
            'departments.*.reference_range' => 'nullable',
            'departments.*.range_type' => 'nullable|in:text,number',
        ]);
        $this->obj->package_departments()->delete();
        foreach ($this->departments as $dep) {
            $this->obj->package_departments()->create([
                'analysis_department_id' => isset($dep['analysis_department_id']) && $dep['analysis_department_id'] != '' ? $dep['analysis_department_id'] : null,
                'range_type' => isset($dep['range_type']) ? $dep['range_type'] : null,
                'reference_range' => isset($dep['reference_range']) ? $dep['reference_range'] : null,
                'min_range' => isset($dep['min_range']) ? $dep['min_range'] : 0,
                'max_range' => isset($dep['max_range']) ? $dep['max_range'] : 0,
                //'sort' => isset($dep['sort']) && $dep['sort'] != '' ? $dep['sort'] : null,
                'strain_id' => $this->strain_id ?? null,
            ]);
        }
    }

    public function addItem()
    {
        $this->departments[] = [
            'analysis_department_id' => '',
            'range_type' => '',
            'reference_range' => '',
            'min_range' => 0,
            'max_range' => 0,
            //'sort' => '',
        ];
    }

    public function removeItem($index)
    {
        unset($this->departments[$index]);
        $this->departments = array_values($this->departments);
    }

    public function packageId($id)
    {
        $this->package_data = Package::find($id);
    }

    public function delete()
    {
        $this->package_data->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الحذف بنجاح']);
    }
}

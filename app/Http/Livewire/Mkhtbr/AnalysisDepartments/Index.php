<?php

namespace App\Http\Livewire\Mkhtbr\AnalysisDepartments;

use Livewire\Component;
use App\Traits\livewireResource;
use App\Models\Mkhtbr\AnalysisDepartment;

class Index extends Component
{
    use livewireResource;
    public $parent, $name_ar, $name_en, $range, $unit, $key, $department, $status, $price, $range_type, $min_range, $max_range, $reference_range;

    protected function rules()
    {
        return [
            'parent' => 'nullable',
            'name_ar' => 'required|string',
            'name_en' => 'nullable',
            'unit' => 'nullable',
            'price' => 'nullable',
            'status' => 'nullable',
            'range_type' => 'nullable',
            'reference_range' => 'nullable|required_if:range_type,text',
            'min_range' => 'nullable|required_if:range_type,number|numeric',
            'max_range' => 'nullable|required_if:range_type,number|numeric'
        ];
    }

    public function mount()
    {
        $this->model = 'App\Models\Mkhtbr\AnalysisDepartment';
    }

    public function beforeSubmit()
    {
        unset($this->data['range_type']);
        $this->data['status'] = $this->status ? 1 : 0;
    }

    public function render()
    {
        $departments = AnalysisDepartment::with(['main'])->when('key', function ($q) {
            $q->where('name_ar', 'LIKE', '%' . $this->key . '%')->orWhere('name_en', 'LIKE', '%' . $this->key . '%');
        })->paginate(10);

        $main_deparments = AnalysisDepartment::all();
        return view('livewire.mkhtbr.analysis-departments.index', compact('departments', 'main_deparments'));
    }


    public function departmentId($id)
    {
        $this->department = AnalysisDepartment::find($id);
    }

    public function delete()
    {
        $this->department->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'تم الحذف بنجاح']);
    }
}

<?php

namespace App\Http\Livewire\Patients;

use App\Exports\PatientByAppointsExport;
use App\Exports\Exports2;

use App\Models\Insurance;
use App\Models\Patient;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

class Export2 extends Component
{
    public $from,$to,$gender;
    public Collection $insurance_export;
    public function between($query,$column)
    {
        if ($this->from && $this->to) {
            $query->whereBetween($column, [$this->from, $this->to]);
        } elseif ($this->from) {
            $query->where($column, '>=', $this->from);
        } elseif ($this->to) {
            $query->where($column, '<=', $this->to);
        } else {
            $query;
        }
    }
    public function export() 
    {
        return Excel::download(new Exports2($this->insurance_export), 'insurance'.time().'.xlsx');
    }
    public function render()
    {
        $insurance=collect();
        if($this->from or $this->to){

        $insurance = Insurance::
            
        get();
    }

        $this->insurance_export=$insurance;
        return view('livewire.patients.export2',compact('insurance'));
    }
}

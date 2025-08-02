<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class PatientByAppointsExport implements FromView
{
    public $patients;
    public function __construct($patients)
    {
        $this->patients=$patients;
    }
    public function view(): View
    {

            return view('exports.patientByAppointsExport', [
                'patients' => $this->patients
            ]);

    }
}

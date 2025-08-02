<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientExport implements FromCollection,  WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Patient::select('first_name', 'phone','gender')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
            'Gender',


        ];
    }


}

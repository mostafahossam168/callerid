<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PatientsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        
        return Patient::select('first_name', 'phone')->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Phone',
        ];
    }
}

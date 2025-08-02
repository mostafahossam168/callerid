<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PatientsInvoiceExport implements FromCollection, WithHeadings
{

    // php artisan make:export PatientInvoiceExport --model=User



    public function collection()
    {
        return Patient::select('first_name', 'phone', 'gender')->get();
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

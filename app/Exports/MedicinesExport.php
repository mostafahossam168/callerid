<?php

namespace App\Exports;

use App\Models\Medicine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicinesExport implements FromCollection, WithHeadings
{

    



    public function collection()
    {
        return Medicine::select('name_ar', 'name_en', 'selling_price', 'cost_price', 'selling_price_with_tax')->get();
    }

    public function headings(): array
    {
        return [
            'ServiceNameAr',
            'ServiceNameEn',
            'SellingPrice',
            'CostPrice',
            'SellingPricewithTax',
        ];
    }
}

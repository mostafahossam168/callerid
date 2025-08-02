<?php

namespace App\Imports;

use App\Models\Medicine;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Validators\Failure;

class MedicinesImport implements OnEachRow, WithValidation, WithStartRow, SkipsOnFailure
{
    use Importable;

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $medicine = Medicine::firstOrCreate(
            [
                'name_ar' => $row[0],
                'name_en' => $row[1],
            ],

            [
                'selling_price'     =>  $row[3],
                'cost_price'     =>  $row[4],
                'selling_price_with_tax'     =>  $row[5],
            ]

        );

        if (!$medicine->wasRecentlyCreated) {
            $medicine->update([
                'name_ar' => $row[0],
                'name_en' => $row[1],
                'selling_price'     =>  $row[3],
                'cost_price'     =>  $row[4],
                'selling_price_with_tax'     =>  $row[5],
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '1' => 'required|unique:medicines,name_ar',
            '2' => 'required|unique:medicines,name_en',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            '1' => __('admin.name_ar'),
            '2' => __('admin.name_en'),
            '4' => __('admin.selling_price'),
            '5' => __('admin.cost_price'),
            '6' => __('admin.selling_price_with_tax'),
        ];
    }

    public function startRow(): int
    {
        return 2;
    }

    public function onFailure(Failure ...$failures)
    {
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class VouchersExport implements FromCollection,WithMapping,WithHeadings
{
    public $vouchers;
    public function __construct($vouchers)
    {
        $this->vouchers = $vouchers;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->vouchers;
    }

    public function map($row) : array
    {

        return [
            $row->voucher_no,
            $row->debit > 0 ? $row->debit : 0,
            $row->credit > 0 ? $row->credit : 0,
            $row->date,
            $row->employee?->name ?? null,
        ];
    }

    public function headings(): array
    {
        return [
            "#",
            __('debtor') ,
            __('creditor'),
            "التاريخ",
             "الموظف",
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Supply;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class SupplyExport implements FromView
{
    public function view(): View
    {
        $supplies = Supply::with('kind')->latest()->get();

        return view('exports.supplies', [
            'supplies' => $supplies
        ]);
    }
}

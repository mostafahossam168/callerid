<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
class AccountStatementExport implements FromView
{
    public  $vouchers;
    public function __construct($vouchers)
    {
        $this->vouchers=$vouchers;
    }
    public function view(): View
    {

            return view('exports.accountStatment', [
                'vouchers' => $this->vouchers,
            ]);

    }
}

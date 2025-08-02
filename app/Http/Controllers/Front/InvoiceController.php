<?php

namespace App\Http\Controllers\Front;
use App\Exports\PatientExport;
use Maatwebsite\Excel\Facades\Excel;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
class InvoiceController extends Controller
{
    use JodaResource;

    public function bonds(Invoice $invoice)
    {
        return view('front.invoice.bonds', compact('invoice'));
    }

    public function getBond(Invoice $invoice)
    {
        return view('front.invoice.showBonds', compact('invoice'));
    }

    public function export()
    {
        return Excel::download(new PatientExport, 'patients' . time() . '.xlsx');
    }
}

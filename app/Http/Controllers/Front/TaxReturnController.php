<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaxReturnController extends Controller
{
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $results = [];
        $dates = [];
        $totals = ['amount' => 0, 'tax' => 0,'total' => 0];
        $BaseDates = [
            ['start' => $currentYear . '-01-01','end' => $currentYear . '-03-31','months' => 'يناير / فبراير / مارس','name' => 'الربع الاول من عام ' . $currentYear ],
            ['start' => $currentYear . '-04-01','end' => $currentYear . '-06-30','months' => 'ابريل / مايو / يونيو','name' => 'الربع الثاني من عام ' . $currentYear ],
            ['start' => $currentYear . '-07-01','end' => $currentYear . '-09-30','months' => 'يوليو / اغسطس / سبتمبر' ,'name' => 'الربع الثالث من عام ' . $currentYear],
            ['start' => $currentYear . '-10-01','end' => $currentYear . '-12-31','months' => 'اكتوبر / نوفمبر / ديسمبر','name' => 'الربع الرابع من عام ' . $currentYear ],
        ];

        foreach($BaseDates as $date){
            // if(Carbon::now()->gt(Carbon::parse($date['end']))){
                $dates[] = $date;
                $invoices = Invoice::whereBetween('created_at',[$date['start'],$date['end']])->where('tax','!=',0)->get();
                $purchases = Purchase::whereBetween('date',[$date['start'],$date['end']])->where('tax','!=',0)->get();
                $results[] = [
                    'total' => $invoices->sum('total'),
                    'amount' => $invoices->sum('amount'),
                    'tax' => $invoices->sum('tax'),
                    'invoices' => $invoices,
                ];
                $pResults []= [
                    'total' => $purchases->sum('amount'),
                    // + $purchases->sum('tax_value'),
                    'tax' => $purchases->sum('tax_value'),
                    'amount' => $purchases->sum('amount') - $purchases->sum('tax_value'),
                ];
                $totals['amount'] += $invoices->sum('amount');
                $totals['tax'] += $invoices->sum('tax');
                $totals['total'] += $invoices->sum('total');
            // }

        }
        // dd($dates,$results,$totals);
        return view('front.tax.index',compact('results','dates','totals','currentYear','pResults'));
    }
}

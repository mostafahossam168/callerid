<?php

namespace App\Http\Livewire\Reports;

use App\Models\Expense;
use App\Models\Invoice;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\InvoiceBond;
use Maatwebsite\Excel\Facades\Excel;

class FinancialReport extends Component
{
    public $amount = 0, $paid_invoices = 0, $partially_paid = 0, $unpaid_invoices = 0,
        $retrieved_invoices = 0, $tax = 0, $expenses = 0, $purchases = 0,
        $cash = 0, $card = 0, $bank = 0, $visa = 0, $mastercard = 0, $to, $from,
        $type = [
            'amount',
            'paid_invoices',
            'partially_paid',
            'unpaid_invoices',
            'tax',
            'expenses',
            'purchases',
            'tab',
            'tamara',
            'cash',
            'card',
            'bank',
            'visa',
            'mastercard',
            'retrieved_invoices',
            'debtorBonds',
            'creditorBonds',
            'services',
            'products'
        ], $tab = 0, $tamara = 0;
    public $debtorBonds, $creditorBonds;
    public function between($query)
    {
        if ($this->from && $this->to) {
            $query->whereDate('created_at', '>=', $this->from)->whereDate('created_at', '<=', $this->to);
        } elseif ($this->from) {
            $query->whereDate('created_at', '>=', $this->from);
        } elseif ($this->to) {
            $query->whereDate('created_at', '<=', $this->to);
        } else {
            $query;
        }
    }
    public function render()
    {
        $this->amount = Invoice::where(function ($q) {
            $this->between($q);
        })->get()->sum('amount');

        $this->paid_invoices = Invoice::where(function ($q) {
            $this->between($q);
        })->get()->sum('paid');

        $this->unpaid_invoices = Invoice::where('status', 'Unpaid')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->retrieved_invoices = Invoice::where('status', 'retrieved')->where(function ($q) {
            $this->between($q);
        })->sum('total');

        $this->partially_paid = Invoice::where('status', 'Partially Paid')->where(function ($q) {
            $this->between($q);
        })->get()->sum('paid');

        $this->tab = Invoice::where('tabby', '>', 0)->where(function ($q) {
            $this->between($q);
        })->sum('tabby');

        $this->tamara = Invoice::where('tamara', '>', 0)->where(function ($q) {
            $this->between($q);
        })->sum('tamara');

        $this->tax = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('paid_tax') + InvoiceBond::where(function ($q) {
            $q->where('status', 'creditor');
            $this->between($q);
        })->sum('tax');

        $this->expenses = Expense::where(function ($q) {
            $this->between($q);
        })->sum('amount');

        $this->purchases = Purchase::where(function ($q) {
            $this->between($q);
        })->sum('amount');

        $this->cash = round(Invoice::where(function ($q) {
            $this->between($q);
        })->sum('cash'), 2);

        $this->card = round(Invoice::where(function ($q) {
            $this->between($q);
        })->sum('card'), 2);

        $this->bank = round(Invoice::where(function ($q) {
            $this->between($q);
        })->sum('bank'), 2);

        $this->visa = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('visa');

        $this->mastercard = Invoice::where(function ($q) {
            $this->between($q);
        })->sum('mastercard');

        $this->debtorBonds = InvoiceBond::where(function ($q) {
            $q->where('status', 'debtor');
            $this->between($q);
        })->sum('amount');
        $this->creditorBonds = InvoiceBond::where(function ($q) {
            $q->where('status', 'creditor');
            $this->between($q);
        })->sum('amount');


        return view('livewire.reports.financial-report');
    }

    // public function export()
    // {
    //     return Excel::download(new FinancialReportExcel($this->from, $this->to), 'financial_reports' . time() . '.xlsx');
    // }
}

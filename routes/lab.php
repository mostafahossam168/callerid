<?php

use App\Models\Analysis;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/lab',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['middleware' => 'auth'], function () {
            Route::view('', 'lab.home')->name('home');
            Route::view('patients', 'lab.patients.index')->name('patients.index');
            Route::view('requests', 'lab.requests.requests')->name('requests');
            Route::get('analysis/create/{invoice_item}', function (InvoiceItem $invoice_item) {
                return view('lab.requests.analysis', compact('invoice_item'));
            })->name('analysis.create');
            Route::get('analysis/{analysis}', function (Analysis $analysis) {
                return view('lab.requests.show_analysis', compact('analysis'));
            })->name('analysis.show');
        });
    }
);

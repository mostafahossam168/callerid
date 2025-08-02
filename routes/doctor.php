<?php

use App\Models\Item;
use App\Models\Patient;
use App\Models\Diagnose;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Doctor\Diagnoses;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Doctor\PatientsController;
use App\Http\Controllers\Doctor\DiagnosesController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Doctor\NotificationController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/doctor',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::group(
            ['middleware' => 'doctor'],
            function () {
                Route::view('', 'doctor.home')->name('home');
                Route::view('interface', 'doctor.interfaces.interface')->name('interface');
                Route::view('diagnose_keywords', 'doctor.diagnose_keywords.index')->name('diagnose_keywords');
                Route::view('appointments', 'doctor.appointments.index')->name('appointments');
                Route::view('appointments-info', 'doctor.appointments.info')->name('appointments_info');
                Route::resource('invoices', InvoiceController::class);
                Route::view('patients', 'doctor.patients.index')->name('patients.index');

                Route::view('/describe', 'doctor.describe')->name('describe');
                Route::view('/describe-show', 'doctor.describe-show')->name('describe-show');

                Route::get(
                    'patients/{patient}',
                    function (Patient $patient) {
                        return view('doctor.patients.show', compact('patient'));
                    }
                )->name('patients.show');
                Route::view('report', 'doctor.report')->name('report');

                Route::resource('doctorpatients', App\Http\Controllers\Doctor\PatientsController::class);
                Route::get(
                    'diagnoses/{diagnose}',
                    function (Diagnose $diagnose) {
                        return view('front.diagnoses.show', compact('diagnose'));
                    }
                )->name('diagnose.show');

                Route::get('/patients/patientFile/{patient}', [PatientsController::class, 'patientFile'])->name('patientFile');

                Route::get('diagnoses', Diagnoses::class)->name('diagnoses.index');
                Route::get('notifications', [NotificationController::class, 'index'])->name('notifications');
                Route::delete('notifications', [NotificationController::class, 'bulkDelete'])->name('notifications.bulk_delete');
                Route::view('products', 'front.products.index')->name('products.index');

                Route::get(
                    'items/quantities/{item}',
                    function (Item $item) {
                        return view('front.items.show', compact('item'));
                    }
                )->name('items.show');
            }
        );
    }
);

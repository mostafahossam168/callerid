<?php

use App\Http\Livewire\Front\PharmacyQuantities;
use App\Http\Livewire\Pharmacy;
use App\Http\Livewire\Reports\VaccinesReport;
use App\Models\Supply;
use App\Models\Appointment;
use App\Http\Livewire\Medicines;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\FormController;
use App\Http\Controllers\Front\GuestsController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\Front\MessageController;
use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\ReportsController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Front\AnalysisController;
use App\Http\Controllers\Front\DiagnoseController;
use App\Http\Controllers\Front\PatientsController;
use App\Http\Controllers\Front\AppointmentController;
use App\Http\Controllers\Front\BankAccountsController;
use App\Http\Controllers\Front\NotificationController;
use App\Http\Controllers\Front\TaxReturnController;
use App\Http\Controllers\Front\UnPaidInvoicesController;
use App\Http\Controllers\Front\VoucherController;
use App\Http\Livewire\Accounts;
use App\Http\Livewire\Front\Reports\CostCenter as ReportsCostCenter;
use App\Http\Livewire\PurchaseInvoices\CreatePurchaseInvoices;
use App\Http\Livewire\PurchaseInvoices\EditPurchaseInvoices;
use App\Http\Livewire\PurchaseInvoices\PurchaseInvoices;
use App\Http\Livewire\Voucher\PaymentVoucher;
use App\Models\Analysis;
use App\Models\CostCenter;
use App\Models\Item;
use App\Models\Mkhtbr\Package;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...

        Route::group(
            ['middleware' => ['auth', 'websiteInActive']],
            function () {
                Route::get(
                    '',
                    function () {
                        if (auth()->user()->isDoctor()) {
                            return redirect()->route('doctor.home');
                        }
                        if (auth()->user()->isScan()) {
                            return redirect()->route('scan.home');
                        }
                        if (auth()->user()->isLab()) {
                            return redirect()->route('lab.home');
                        }
                        return view('front.home');
                    }
                )->name('home');
                // Route::get('/guide', function () {
                //     $manuals = UserManual::get();
                //     return view('front.guide', compact('manuals'));
                // })->name('guide');
                Route::view('/vaccination', 'front.vaccination.index')->name('vaccination');
                Route::get('/guide', [QuestionController::class, "get_all_questions"])->name('guide');
                Route::get('/pharmacy', Pharmacy::class)->name('pharmacy');
                Route::view('/describe', 'front.describe')->name('describe');
                Route::get('/describe-show/{describe}', function (\App\Models\PharmacyPrescription $describe) {
                    return view('front.describe-show', compact('describe'));
                })->name('describe-show');
                Route::view('/program-update', 'admin.program-update')->name('program-update');
                Route::view('lab-table', 'front.AnimalTests.screens.lab-table')->name('lab-table');
                Route::view('lab-table-2', 'front.AnimalTests.screens.lab-table-2')->name('lab-table-2');
                Route::view('lab-order', 'front.lab-order.index')->name('lab-order');
                Route::view('lab-order/show', 'front.lab-order.show')->name('lab-order.show');
                Route::view('analysis', 'front.animalForm.analysis')->name('analysis');
                Route::view('sheep', 'front.animalForm.sheep')->name('sheep');
                Route::view('blood', 'front.animalForm.blood')->name('blood');
                Route::view('brucellosis', 'front.animalForm.brucellosis')->name('brucellosis');

                Route::get('analysis/{analysis}', function (Analysis $analysis) {
                    return view('front.analysis.show', compact('analysis'));
                })->name('analysis.show');

                Route::get('patients/{patient}/animals', [PatientsController::class, 'animals'])->name('patients.animals');
                Route::get('animals/{animal}', [PatientsController::class, 'animal'])->name('animals.show');
                Route::get('animals/{animal}/edit', [PatientsController::class, 'editAnimal'])->name('animals.edit');
                Route::put('animals/update/{animal}', [PatientsController::class, 'updateAnimal'])->name('animals.update');
                Route::get('patients/export', [PatientsController::class, 'export'])->name('patients.export');
                Route::get('insurance/export', [PatientsController::class, 'insurance'])->name('insurances.export');

                Route::get('patients-invoice/export', [InvoiceController::class, 'export'])->name('patientsInvoice.export');
                Route::get('export/patients', [PatientsController::class, 'export'])->name('export.patients');
                Route::get('export/insurance', [PatientsController::class, 'exportInsurances'])->name('export.insurances');

                Route::resource('patients', PatientsController::class);
                Route::get('/patients/patientFile/{patient}', [PatientsController::class, 'patientFile'])->name('patientFile');
                // Route::get('/patients/patientFile/', [PatientsController::class , 'patientFile'])->name('patientFile');

                Route::get('/message', [MessageController::class, 'index'])->name('message');
                Route::post('/message', [MessageController::class, 'send'])->name('message.send');

                Route::view('appointments-transferred', 'front.appointment.transferred')->name('appointment.transferred');
                Route::view('appointments-info', 'front.appointment.info')->name('appointments_info');
                Route::get(
                    'print-transferred/{appointment}',
                    function (Appointment $appointment) {
                        return view('front.patients.print-transfer', compact('appointment'));
                    }
                )->name('appointment.print-transfer');
                Route::view('today_appointments', 'front.appointment.today_appointments')->name('appointments.today_appointments');

                Route::resource('forms', FormController::class);
                Route::resource('invoices', InvoiceController::class);
                Route::get('invoices/bonds/{invoice}', [InvoiceController::class, 'bonds'])->name('invoices.bonds');

                // Accounting
                Route::view('accounting', 'front.accounting')->name('accounting');
                Route::view('accounting-department', 'front.selectfilter')->name('selectfilter');
                Route::view('selectfilter', 'front.accounting-department')->name('accounting-department');
                Route::post('accountring_year_save', function () {
                    cache(['accounting_year' => request()->get('accounting_year')]);
                    return redirect()->back();
                })->name('accountring_year_save');
                Route::get('accounts-tree', Accounts::class)->name('accounts-tree');
                Route::group(['middleware' => ['permission:create_cost_centers|read_cost_centers|update_cost_centers|delete_cost_centers']], function () {
                    //                    Route::view('cost_centers', 'front.cost_centers.index')->name('cost_centers');
                    Route::get('cost_centers/{cost_center}', function (CostCenter $cost_center) {
                        return view('front.cost_centers.show', compact('cost_center'));
                    })->name('cost_centers.show');
                });
                Route::get('vouchers/report', [VoucherController::class, 'report'])->name('vouchers.report');
                Route::get('vouchers/payment_voucher', PaymentVoucher::class)->name('vouchers.payment_voucher');
                Route::resource('vouchers', VoucherController::class);
                Route::resource('bank-accounts', BankAccountsController::class);
                Route::view('/account-statement', 'front.account-statement')->name('account-statement');
                Route::view('reception-restrictions', 'front.reception-restrictions')->name('reception-restrictions');
                Route::view('voucher-report', 'front.voucher-report')->name('voucher-report');
                Route::get('cost_center_report', ReportsCostCenter::class)->name('cost_center.report');
                Route::get('tax', [TaxReturnController::class, 'index'])->name('tax.index');
                Route::view('review', 'front.review.index')->name('review');
                Route::view('review/create', 'front.review.create')->name('review.create');

                Route::get('/treasury', [ReportsController::class, 'treasury']);
                Route::view('reports', 'front.reports')->name('reports');
                Route::view('treasuryAccount', 'front.reports.treasury-account')->name('treasury_account');
                Route::view('patient-report', 'front.reports.patients')->name('patient_report');
                Route::view('clidoc-report', 'front.reports.clidoc-report')->name('Clidoc_report');
                Route::view('financial-report', 'front.reports.financial-report')->name('Financial_report');
                Route::view('sales-report', 'front.reports.sales-report')->name('sales_report');
                Route::get('/sales/report', [ReportsController::class, 'sales_report'])->name('sales.report');

                Route::view('offers-report', 'front.reports.offers')->name('offers_report');
                Route::view('products-report', 'front.reports.products')->name('products_report');
                Route::get('vaccine-report', VaccinesReport::class)->name('vaccine_report');
                Route::view('items-report', 'front.reports.items')->name('items_report');
                Route::view('expenses-report', 'front.reports.expenses')->name('expenses_report');
                Route::view('purchases-report', 'front.reports.purchases')->name('purchases_report');
                Route::view('insurances-report', 'front.reports.insurances-report')->name('insurances_report');
                Route::view('not-saudis-report', 'front.reports.not-sudies')->name('not_sudies');
                Route::view('queue-report', 'front.reports.queue-report')->name('queue_report');
                Route::view('strains', 'front.reports.strains')->name('strains');
                Route::view('reception-staff-report', 'front.reports.reception-staff-report')->name('reception_staff_report');
                Route::view('animals-report', 'front.reports.animal-report')->name('animals_report');
                Route::view('brucellosis-report', 'front.AnimalTests.screens.brucellosis-report')->name('brucellosis-report');
                Route::view('blood-parasites-report', 'front.AnimalTests.screens.blood-parasites-report')->name('blood-parasites-report');
                Route::get('hotel-report', \App\Http\Livewire\Front\HotelReport::class)->name('hotel_report');
                Route::view('products_and_items', 'front.reports.products_and_items')->name('products_and_items');
                Route::view('pay-visit', 'front.invoice.pay-visit')->name('pay_visit');
                Route::view('queue', 'front.queue')->name('queue');
                Route::get('create/guest', [GuestsController::class, 'index'])->name('guests.create');
                //Profile Route
                Route::get('profile', [ProfileController::class, 'index'])->name('profile');
                Route::post('profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');

                Route::view('diagnoses', 'front.diagnoses.index')->name('diagnoses.index');
                Route::put('diagnoses/{diagnose}', [DiagnoseController::class, 'update'])->name('diagnoses.update');
                Route::get('diagnoses/{diagnose}', [DiagnoseController::class, 'show'])->name('diagnoses.show');
                Route::get('diagnoses/{diagnose}/edit', [DiagnoseController::class, 'edit'])->name('diagnoses.edit');
                Route::view('products', 'front.products.index')->name('products.index');
                Route::view('medicines', 'front.medicines.index')->name('medicines.index');
                Route::get('medicines/export', [Medicines::class, 'export'])->name('medicines.export');
                Route::view('offers', 'front.offers.index')->name('offers.index');
                Route::view('salaries', 'front.salaries.index')->name('salaries.index');
                Route::view('departments', 'front.departments.index')->name('departments.index');
                Route::view('categories', 'front.categories.index')->name('categories.index');
                Route::view('expenses', 'front.expenses.index')->name('expenses.index');
                Route::view('expenses_categories', 'front.expense_categories.index')->name('expenses_categories.index');
                Route::view('purchases', 'front.purchases.index')->name('purchases.index');
                Route::resource('scan-requests', \App\Http\Controllers\Front\ScanRequestController::class);
                Route::view('lab-requests', 'front.requests.lab-requests')->name('lab_requests');
                Route::view('scan-requests', 'front.requests.scan-requests')->name('scan_requests');
                Route::view('scan-requests', 'front.requests.scan-requests')->name('scan_requests');
                Route::view('pharmacy-requests', 'front.requests.pharmacy-requests')->name('pharmacy_requests');

                Route::view('kinds', 'front.kinds.index')->name('kinds');
                Route::view('purchase-categories', 'front.purchase-categories.index')->name('purchase-categories');
                Route::view('stores', 'front.stores.index')->name('stores');
                Route::view('supplies', 'front.supplies.index')->name('supplies');
                Route::get('test-form/{file}', \App\Http\Livewire\TestForm::class)->name('test-form');
                Route::get('show-test/{id}', \App\Http\Controllers\Front\ShowAnimalTestController::class)
                    ->name('show-test');
                Route::get(
                    'supplies/quantities/{supply}',
                    function (Supply $supply) {
                        return view('front.supplies.show', compact('supply'));
                    }
                )->name('supplies.show');

                Route::resource('appointments', AppointmentController::class);
                Route::delete('/appointments/bulk_delete/{ids}', [AppointmentController::class, 'bulkDelete'])->name('appointments.bulk_delete');
                Route::delete('/products/bulk_delete/{ids}', [AppointmentController::class, 'bulkDelete_products'])->name('products.bulk_delete');


                Route::view('notifications', 'front.notifications')->name('notifications');
                Route::delete('/notifications/bulk_delete/{ids}', [NotificationController::class, 'bulkDelete'])->name('notifications.bulk_delete');
                Route::view('/points', 'front.points.index')->name('points');

                Route::view('warehouses', 'front.warehouses.index')->name('warehouses');
                Route::view('units', 'front.units.index')->name('units');
                Route::view('suppliers', 'front.suppliers.index')->name('suppliers');
                //Route::view('payment_methods', 'front.payment_methods.index')->name('payment_methods');
                Route::view('cost_centers', 'front.cost_centers.index')->name('cost_centers');

                Route::view('items', 'front.items.index')->name('items');
                Route::get(
                    'items/quantities/{item}',
                    function (Item $item) {
                        return view('front.items.show', compact('item'));
                    }
                )->name('items.show');
                Route::get('item-categories', \App\Http\Livewire\Front\ItemCategories::class)->name('item-categories');
                Route::get('medicine/quantities/{item?}', PharmacyQuantities::class)
                    ->name('medicine.quantities.show');



                Route::view('orders', 'front.orders.index')->name('orders');
                Route::view('orders/create', 'front.orders.create')->name('orders.create');

                Route::get(
                    'orders/{order}',
                    function ($id) {
                        return view('front.orders.show', compact('id'));
                    }
                )->name('orders.show');

                /* Route::get('purchase_invoices', PurchaseInvoices::class)->name('purchase_invoices');
                Route::get('purchase_invoices/create', CreatePurchaseInvoices::class)->name('purchase_invoices.create');
                Route::get('purchase_invoices/{purchase_invoice}/edit', EditPurchaseInvoices::class)->name('purchase_invoices.edit'); */

                //Route::get('vouchers/receipt_voucher', ReceiptVoucher::class)->name('vouchers.receipt_voucher');




                ###################################  Start Mkhtbr Routes   ###########################################
                if (setting()->active_mkhtbr) {
                    Route::view('packages', 'front.packages.index')->name('packages');
                    Route::get('packages/{package}', function (Package $package) {
                        return view('front.packages.show', compact('package'));
                    })->name('packages.show');

                    Route::view('analysis_departments', 'front.analysis_departments.index')->name('analysis_departments');
                    Route::get('mkhtbr-analysis/{id?}', function ($id = null) {
                        return view('front.analysis.index', compact('id'));
                    })->name('mkhtbr-analysis');
                    Route::get('analysis/export/{analysis}', [AnalysisController::class, 'export'])->name('analysis.export');
                    Route::get('analysis/{analysis}/show', function (\App\Models\Mkhtbr\MkhtbrAnalysis $analysis) {
                        return view('front.analysis.show2', compact('analysis'));
                    })->name('analysis.show');
                    Route::get('analysis/result/{hash_code}', [AnalysisController::class, 'showExternal'])->name('showAnalysisExternal');
                }

                #####################################  End Mkhtbr Routes   ###################################
            }






        );

        // for unauthorized
        Route::get('invoice/{invoice}/send', function (\App\Models\Invoice $invoice) {
            return view('front.invoice.send', compact('invoice'));
        })->name('invoice.send');
    }
);
<?php

use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use App\Http\Livewire\Front\Home;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Front\PatientsController;

require __DIR__ . '/admin.php';

//  Route::get('{any}', function() {
//     return redirect()->route('admin.login');
// })->where('any', '.*');

Route::post('backup-database', [BackupController::class, 'backupDatabase'])->name('backup-database');
Route::view('/404', '404');
Route::view('doctor/medicalInfo', 'doctor/medicalInfo');

// Route::get('/guide', [QuestionController::class, "get_all_questions"])->name('guide');
Route::view('/program-update', 'admin.program-update')->name('program-update');


require_once __DIR__ . '/fortify.php';

Route::group(['prefix' => 'pharmacy'], function () {
    Route::view('/', 'pharmacy.home')->name('home');
});

Route::view('/animals/add-item', 'front/animals/add-item')->name('front.add-item');

Route::view('admin/analysisLab', 'admin/analysisLab')->name('analysisLab');
Route::view('invoices/pill', 'front/invoice/pill')->name('pill');
Route::view('ar/showBonds', 'front.invoice.showBonds')->name('showBonds');
Route::get('test', function () {
    $notification_ids = Notification::whereNotNull('invoice_id')->pluck('invoice_id')->toArray();

    return  Invoice::whereRelation('department', 'is_hotel_service', 1)
        ->where('departure_date', now()->addDay()->format('Y-m-d'))
        ->whereNotIn('id', $notification_ids)
        ->get();
});


Route::get('select2/patients', [\App\Http\Controllers\Select2Pagination::class, 'patients']);
Route::get('select2/products', [\App\Http\Controllers\Select2Pagination::class, 'products']);
Route::get('select2/animals', [\App\Http\Controllers\Select2Pagination::class, 'animals']);
Route::get('select2/items', [\App\Http\Controllers\Select2Pagination::class, 'items']);
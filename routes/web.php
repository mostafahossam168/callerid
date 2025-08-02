<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Auth::routes();
        Route::get('/', [DashboardController::class, 'index'])->name('home')->middleware('admin');

        // Route::get('/', function () {
        //     return view('front.index');
        // })->name('home');

        // Route::view('articles', 'front.article')->name('articles');
        // Route::view('contact', 'front.contact')->name('contact');
        // Route::post('contact/store', [ContactUsController::class, 'store'])->name('contact.store');
        // Route::view('contracts', 'front.contracts')->name('contracts');
        // Route::view('jobs', 'front.jobs')->name('jobs');
        // Route::view('notice', 'front.notice')->name('notice');
        // Route::view('profile', 'front.profile')->name('profile');
        // Route::view('reseat', 'front.reseat')->name('reseat');
        // Route::view('show-administrative-job', 'front.show-administrative-job')->name('show-administrative-job');
        // Route::view('show-employer-job', 'front.show-employer-job')->name('show-employer-job');
        // Route::view('settings', 'front.site-settings')->name('settings');
        // Route::view('subscriptions', 'front.subscription')->name('subscriptions');
        // Route::view('treasury', 'front.treasury')->name('treasury');
        // Route::view('users', 'front.users')->name('users');

        // Route::view('tickets', 'front.tickets.index')->name('tickets.index');
        // Route::view('tickets/create', 'front.tickets.create')->name('tickets.create');
        // Route::view('tickets/show', 'front.tickets.show')->name('tickets.show');


    }
);

/* ckeditor upload images */
Route::post('/upload_images', function (Request $request) {
    $image = $request->file('upload');
    $imageName = time() . '.' . $image->getClientOriginalExtension();
    $uploadPath = public_path('uploads/articles');
    $resizedImage = \Intervention\Image\Facades\Image::make($image)->resize(600, 600, function ($constraint) {
        $constraint->aspectRatio();
    });
    $resizedImage->save($uploadPath . '/' . $imageName);
    return response()->json(['uploaded' => 1, 'url' => display_file('/articles/' . $imageName)]);
})->name('image.upload');
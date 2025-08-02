<?php

use App\Http\Controllers\Admin\ArticlesController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PrivacyPolicyController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\UsagePolicyController;
use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Cities;
use App\Livewire\Admin\Clients;
use App\Livewire\Admin\Contacts;
use App\Livewire\Admin\Countries;
use App\Livewire\Admin\EmailMenu;
use App\Livewire\Admin\Gifts;
use App\Livewire\Admin\Menus;
use App\Livewire\Admin\Messages\Image;
use App\Livewire\Admin\Messages\MessagesSent;
use App\Livewire\Admin\Messages\SendMessage;
use App\Livewire\Admin\Messages\Text;
use App\Livewire\Admin\Pages;
use App\Livewire\Admin\Programs;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\SubCategories;
use App\Livewire\Admin\Users;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        Route::prefix('admin')->group(function () {
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });

            Route::view('login', 'admin.login')->middleware('admin_guest')->name('login');
            Route::post('login', [AuthController::class, 'login'])->middleware('admin_guest')->name('login.post');

            Route::group(['middleware' => 'admin'], function () {

                Route::get('/', [DashboardController::class, 'index'])->name('home');
                Route::get('settings', Settings::class)->name('settings');
                Route::get('programs', Programs::class)->name('programs');
                Route::get('cities', Cities::class)->name('cities');
                Route::get('countries', Countries::class)->name('countries');
                Route::get('clients', Clients::class)->name('clients');
                Route::get('gifts', Gifts::class)->name('gifts');
                Route::get('contacts', Contacts::class)->name('contacts');
                Route::get('categories', Categories::class)->name('categories');
                Route::get('sub_categories', SubCategories::class)->name('sub-categories');
                Route::view('/all_articles', 'admin.articles.index')->name('all_articles');
                Route::resource('articles', ArticlesController::class);
                // Route::resource('articles', ArticlesController::class);

                Route::get('gifts' , \App\Livewire\Admin\Gifts::class)->name('gifts');
                Route::get('menus', Menus::class)->name('menus');
                Route::get('pages', Pages::class)->name('pages');

                Route::get('users', Users::class)->name('users');
                Route::get('roles', Roles::class)->name('roles');
                Route::get('text-message', Text::class)->name('texts');
                Route::get('images-message', Image::class)->name('images');
                Route::get('sendMessage', SendMessage::class)->name('SendMessage');
                Route::get('MessagesSent', MessagesSent::class)->name('MessagesSent');
                Route::resource('contact-us', ContactUsController::class);
                Route::get('contactes', \App\Livewire\Admin\ContactUs::class)->name('contactes');
                Route::get('email_menu', EmailMenu::class)->name('email_menu');

                Route::resource('/library', \App\Http\Controllers\Admin\LibraryController::class);
                Route::post('/library/deleteAll', [\App\Http\Controllers\Admin\LibraryController::class, 'deleteAll'])->name('library.deleteAll');
                Route::get('/vendors', \App\Livewire\Admin\Vendors::class)->name('vendors.index');
                //    Route::view('/vendors/create', 'admin.vendors.create')->name('vendors.create');
                //    Route::view('/vendors/edit', 'admin.vendors.edit')->name('vendors.edit');
                //
                Route::view('/articles-categories', 'admin.articles-categories.index')->name('articles-categories.index');
                Route::view('/articles-categories/create', 'admin.articles-categories.createOrUpdate')->name('articles-categories.create');
                Route::view('/articles-categories/edit', 'admin.articles-categories.edit')->name('articles-categories.edit');

                Route::view('/sliders', 'admin.sliders.index')->name('sliders.index');

                Route::resource('tickets', TicketController::class);
                Route::post('tickets/storeComment', [TicketController::class, 'storeComment'])->name('tickets.storeComment');

                // livewire
                Route::get('products', \App\Livewire\Admin\Products::class)->name('products');
                Route::view('/articles', 'admin.articles.index')->name('articles.index');
                // livewire
                Route::get('products', \App\Livewire\Admin\Products::class)->name('products');
                // Route::view('/articles', 'admin.articles.index')->name('articles.index');

                Route::get('/notifications', \App\Livewire\Admin\Notifications::class)->name('notifications.index');
                Route::resource('privacy-policy', PrivacyPolicyController::class)->only('index', 'update');
                Route::resource('usage-policy', UsagePolicyController::class)->only('index', 'update');
                Route::get('/generate-translation', function () {
                    Artisan::call('translations:find');
                    return back()->with('success', 'تم بنجاح !');
                })->name('generate-translation');
                //    Route::view('/notifications/create','admin.notifications.create')->name('notifications.create');
            });
        });
    }
);
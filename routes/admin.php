<?php

use App\Http\Livewire\Admin\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Home\Home;
use App\Http\Livewire\Admin\Roles\Roles;
use App\Http\Livewire\Admin\Users\Users;
use App\Http\Livewire\Admin\Admins\Admins;
use App\Http\Livewire\Admin\ConstSettings;
use App\Http\Livewire\Admin\Messages\Text;
use App\Http\Controllers\Admin\LabCategory;
use App\Http\Livewire\Admin\Messages\Image;
use App\Http\Controllers\Admin\LabController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Livewire\Admin\Settings\Settings;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\StrainController;
use App\Http\Controllers\Admin\SubmitController;
use App\Http\Livewire\Admin\SendMessageSettings;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Livewire\Admin\Messages\SendMessage;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PatientsController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RememberController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Livewire\Admin\Messages\MessagesSent;
use App\Http\Controllers\Admin\InsuranceController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ScanServiceController;
use App\Http\Controllers\Admin\RelationshipController;
use App\Http\Controllers\Admin\ProductPercentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () { //...
        Route::view('admin/login', 'admin.login')->middleware('admin_guest')->name('admin.login');
        Route::post('admin/login', [AuthController::class, 'login'])->middleware('admin_guest')->name('admin.login.post');

        Route::group(['middleware' => 'admin', 'as' => 'admin.', 'prefix' => 'admin'], function () {
            Route::view('/', 'admin.home')->name('home');
            Route::view('settings', 'admin.settings')->name('settings');

            Route::post('settings', [SettingsController::class, 'settings'])->name('settings.update');
            Route::get('profile', [ProfileController::class, 'show'])->name('profile');
            Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::resource('departments', DepartmentController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('relationships', RelationshipController::class);
            Route::resource('cities', CityController::class);
            Route::resource('strains', StrainController::class);

            Route::resource('countries', CountryController::class);
            Route::resource('rooms', RoomController::class);
            Route::resource('users', UsersController::class);
            Route::resource('product_percents', ProductPercentController::class);
            Route::resource('patients', PatientsController::class);
            Route::resource('forms', FormController::class);
            Route::resource('invoices', \App\Http\Controllers\Admin\InvoiceController::class)->only('index', 'show');
            Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class)->only('index', 'show');
            Route::resource('diagnoses', \App\Http\Controllers\Admin\DiagnosesController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('products', ProductController::class);
            Route::resource('insurances', InsuranceController::class);
            Route::resource('labs', LabController::class);
            Route::resource('lab-categories', LabCategory::class);
            Route::resource('scan-services', ScanServiceController::class);
            Route::resource('services', ServiceController::class);
            // questions editing
            Route::resource('questions', QuestionController::class);
            Route::get('ar/admin/add-video', [QuestionController::class, "add_video"])->name("questions.add_video");
            Route::post('ar/admin/store-video', [QuestionController::class, "store_video"])->name("questions.store_video");
            Route::get('ar/admin/add-images', [QuestionController::class, "add_images"])->name("questions.add_images");
            Route::post('ar/admin/store-images', [QuestionController::class, "store_images"])->name("questions.store_images");
            Route::resource('sms', RememberController::class);

            Route::resource('submits', SubmitController::class);

            /* ********************** Livewire ********************* */
            Route::view('/admin/program-update', 'admin.program-update')->name('program-update');
            Route::view('stores', 'admin.stores.index')->name('stores');
            Route::view('kinds', 'admin.kinds.index')->name('kinds');
            Route::view('supplies', 'admin.supplies.index')->name('supplies');
            Route::view('faqs', 'admin.faqs.index')->name('faqs');

            Route::get('massage', [MessageController::class, 'setting'])->name('massage.index');
            Route::post('/message/settings', [MessageController::class, 'settingStore'])->name('message.setting.store');
            Route::resource('notifications', \App\Http\Controllers\Admin\NotificationController::class)
                ->only('index', 'destroy');

            Route::get('message_library/text_message', Text::class)->name('message_library.texts');
            Route::get('message_library/images_message', Image::class)->name('message_library.images');
            Route::get('message_library/send_message', SendMessage::class)->name('message_library.send_message');
            Route::get('message_library/messages_settings', SendMessageSettings::class)->name('message_library.send_message_settings');
            Route::get('message_library/sent_messages', MessagesSent::class)->name('message_library.sent_messages');

            Route::get('const', ConstSettings::class)->name('const');
        });
    }
);
Route::get('select2-patients',[\App\Http\Controllers\Admin\Select2Pagination::class,'patients'])
    ->name('select2-patients')
    ->middleware('admin')
;

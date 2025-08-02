<?php

namespace App\Providers;

use App\Models\Appointment;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Supplier;
use App\Observers\InvoiceObserve;
use App\Observers\NotificationObserver;
use App\Observers\SupplierObserver;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->type == 'admin';
        });
        Blade::if('dr', function () {
            return auth()->check() && auth()->user()->type == 'dr';
        });
        Blade::if('recep', function () {
            return auth()->check() && auth()->user()->type == 'recep';
        });
        Blade::if('lab', function () {
            return auth()->check() && auth()->user()->type == 'lab';
        });
        Blade::if('scan', function () {
            return auth()->check() && auth()->user()->type == 'scan';
        });

        // observers
        Invoice::observe(InvoiceObserve::class);
        Notification::observe(NotificationObserver::class);
        Supplier::observe(SupplierObserver::class);
        Paginator::useBootstrap();
        Debugbar::disable();
    }
}

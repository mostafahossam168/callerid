<nav class="bottom-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <div class="nav-holder d-flex align-items-center justify-content-between">
            <ul class="list-item flex-fill">
                @auth
                <li>
                    <a class="item" href="{{ route('front.home') }}">
                        {{ __('admin.home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>
                @endauth
                @can('read_patients')
                <li>
                    <a class="item" href="{{ route('front.patients.index') }}">
                        {{ __('admin.patients') }}
                        <i class="i-item fa-solid fa-users"></i>
                    </a>
                </li>
                @endcan
                @can('read_appointments')
                <li>
                    <a class="item" href="{{ route('front.appointments.index') }}">
                        {{ __('admin.Appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>
                <li>
                    <a class="item" href="{{ route('front.appointments.today_appointments') }}">
                        {{ __('admin.today_appointments') }}
                        <i class="i-item fa-solid fa-calendar-days"></i>
                    </a>
                </li>
                @endcan
                @can('read_invoices')
                <li>
                    <a class="item" href="{{ route('front.invoices.index') }}">
                        {{ __('admin.invoices') }}
                        <i class="i-item fa-solid fa-file-invoice"></i>
                    </a>
                </li>
                @endcan
                @can('read_diagnoses')
                <li>
                    <a class="item" href="{{ route('front.diagnoses.index') }}">
                        {{ __('admin.Diagnoses') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                    </a>
                </li>
                @endcan
                @if (setting()->pharmacy_status)
                {{-- <li>
                        <a class="item" href="{{ route('front.scan_requests') }}">
                {{ __('Rays') }}
                <i class="i-item fa-solid fa-money-check-dollar"></i>
                <div class="badge-count">{{ App\Models\ScanRequest::where('status', 'pending')->count() }}
                </div>
                </a>
                </li> --}}
                @auth
                @can('lab_requests')
                <li>
                    <a class="item" href="{{ route('front.lab-order') }}">
                        {{ __('Lab Orders') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                    </a>
                </li>
                @endcan
                @canany(['read_pharmacy_warehouse','read_pharmacy_dangerous','read_pharmacy_medicine','read_pharmacy_types'])
                <li>
                    <a class="item" href="{{ route('front.pharmacy') }}">
                        {{ __('pharmacy') }}
                        <i class="i-item fa-solid fa-clinic-medical"></i>
                    </a>
                </li>
                @endcanany
                @endauth
                @endif

                @can('read_queue')
                <li>
                    <a class="item" href="{{ route('front.queue') }}">
                        {{ __('Queue') }}
                        <i class="i-item fa-solid fa-clipboard-list"></i>
                        <div class="badge-count">
                            {{ App\Models\Queue::count() }}
                        </div>
                    </a>
                </li>
                @endcan
                @can('pay_visits')
                <li>
                    <a class="item" href="{{ route('front.pay_visit') }}">
                        {{ __('admin.Pay a visit') }}
                        <i class="i-item fa-solid fa-money-check-dollar"></i>
                        <div class="badge-count">
                            {{ App\Models\Invoice::where('status', 'Unpaid')->count() }}
                        </div>
                    </a>
                </li>
                @endcan
                @can('read_orders')
                <li>
                    <a class="item" href="{{ route('front.orders') }}">
                        {{ __('admin.Seles') }}
                        <i class="i-item fa-solid fa-money-bill-transfer"></i>
                    </a>
                </li>
                @endcan
            </ul>
            <ul class="list-item">
                @if (app()->getLocale() == 'ar')
                <li>
                    <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('en') }}"> <i class="fa-solid fa-language"></i></a>
                </li>
                @else
                <li>
                    <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> <i class="fa-solid fa-language"></i></a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

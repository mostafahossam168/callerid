<nav class="top-nav not-print">
    <div class="container">
        <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <ul class="list-item">
            @auth
                @canany(['read_departments', 'read_categories', 'read_services', 'read_offers', 'read_products',
                    'read_kinds'])
                    <li>

                        <div class="dropdown-hover item">
                            <a class="d-flex">{{ __('admin.Administration') }}
                                <div class="arrow-icon me-1">
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                            </a>
                            <ul class="listis-item " id="dropdown-lang">
                                @can('read_departments')
                                    <li>
                                        <a href="{{ route('front.departments.index') }}"
                                            class="d-flex">{{ __('admin.departments') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('read_categories')
                                    <li>
                                        <a href="{{ route('front.categories.index') }}"
                                            class="d-flex">{{ __('admin.maincategories') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('read_products')
                                    <li>
                                        <a href="{{ route('front.products.index') }}" class="d-flex">{{ __('admin.items') }}
                                        </a>
                                    </li>
                                @endcan
                                <li>
                                    <a href="{{ route('front.vaccination') }}" class="d-flex">{{ __('Vaccinations') }}
                                    </a>
                                </li>
                                @can('read_kinds')
                                    <li>
                                        <a href="{{ route('front.kinds') }}" class="d-flex">
                                            {{ __('Clinic warehouse') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('read_products')
                                    <!-- <li>
                                                                                        <a href="{{ route('front.items') }}" class="d-flex">{{ __('admin.Products') }}
                                                                                        </a>
                                                                                    </li> -->
                                @endcan
                                @can('read_offers')
                                    <li>
                                        <a href="{{ route('front.offers.index') }}" class="d-flex">{{ __('admin.Offers') }}
                                        </a>
                                    </li>
                                @endcan

                                <!-- <li>
                                                                    <a href="{{ route('front.item-categories') }}" class="d-flex">{{ __('admin.item_categories') }}
                                                                    </a>
                                                                </li> -->
                            </ul>
                        </div>
                    </li>
                    @if (setting()->active_mkhtbr)
                        @canany(['read_packages', 'read_analysis_departments', 'read_analysis'])
                            <li>
                                <div class="dropdown-hover item">
                                    <a class="d-flex">المختبر
                                        <div class="arrow-icon me-1">
                                            <i class="fa-solid fa-angle-down"></i>
                                        </div>
                                    </a>
                                    <ul class="listis-item " id="dropdown-lang">
                                        @can('read_packages')
                                            <li>
                                                <a href="{{ route('front.packages') }}" class="d-flex">اقسام التحاليل
                                                </a>
                                            </li>
                                        @endcan
                                        @can('read_analysis_departments')
                                            <li>
                                                <a href="{{ route('front.analysis_departments') }}" class="d-flex">اقسام
                                                    المختبر
                                                </a>
                                            </li>
                                        @endcan
                                        @can('read_analysis')
                                            <li>
                                                <a href="{{ route('front.mkhtbr-analysis') }}" class="d-flex">نتائج التحاليل
                                                </a>
                                            </li>
                                        @endcan

                                    </ul>
                                </div>
                            </li>
                        @endcanany
                    @endif
                @endcanany
            @endauth
            @can('read_forms')
                <li>
                    <a href="{{ route('front.forms.index') }}" class="d-flex">{{ __('admin.Forms') }}
                    </a>
                </li>
            @endcan
            @can('read_suppliers')
                <li>
                    <a href="{{ route('front.suppliers') }}" class="d-flex">{{ __('admin.suppliers') }}
                    </a>
                </li>
            @endcan
            @can('read_transferred')
                <li>
                    <a href="{{ route('front.appointment.transferred') }}" class="d-flex">
                        {{ __('admin.Referrals_to_the_doctor') }}
                        <div class="badge-count me-1 mb-1">
                            {{ App\Models\Appointment::where('appointment_status', 'transferred')->count() }}
                        </div>
                    </a>
                </li>
            @endcan
            @auth
                @canany(['read_reports', 'read_purchases'])
                    <li>
                        <div class="dropdown-hover item">
                            <a class="d-flex">{{ __('Accounting and reports') }}
                                <div class="arrow-icon me-1">
                                    <i class="fa-solid fa-angle-down"></i>
                                </div>
                            </a>
                            <ul class="listis-item " id="dropdown-lang">
                                @can('read_reports')
                                    <li>
                                        <a href="{{ route('front.reports') }}" class="d-flex">
                                            {{ __('Accounting and reports') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('read_purchases')
                                    <li>
                                        <a href="{{ route('front.purchases.index') }}" class="d-flex">
                                            {{ __('purchases') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcanany
            @endauth


            {{-- <li>
              <a href="{{ route('front.points') }}" class="d-flex">
            {{ __('admin.loyalty_points') }}
            </a>
            </li> --}}
            @auth
                <li>
                    <a href="{{ route('front.program-update') }}" class="d-flex">
                        @lang('about the program')
                    </a>
                </li>
            @endauth
        </ul>

        {{-- <a target="_blank" href="{{ route('front.home') }}"> --}}
        @auth
            <div class="d-flex align-items-center gap-2">
                <ul class="list-item notification">
                    @if (auth()->user()?->type == 'admin')
                        <li class="ms-2">
                            <a target="_blank" class="item" href="{{ route('admin.home') }}">
                                {{ __('admin.Dashboard') }}
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="item" href="{{ route('front.notifications') }}">
                            <i class="i-item fa-solid fa-bell"></i>
                            <div class="badge-count">{{ App\Models\Notification::where('seen', false)->count() }}</div>
                        </a>
                    </li>
                </ul>
                <div class="dropdown-hover" data-show="dropdown-lang">
                    <div class="icon-drop">
                        <i class="fa-solid fa-user icon"></i>
                    </div>
                    <p class="text">{{ auth()->user()?->name }}</p>
                    <div class="arrow-icon">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <ul class="listis-item" id="dropdown-lang">
                        <li class="item-drop">
                            <a href="#">
                                <p class="text">
                                    <form class="w-100" action="{{ route('logout') }}" method="POST" id="logout-form">
                                        @csrf
                                        <button class="border-0 bg-transparent p-0">
                                            <p class="text"> {{ __('log out') }}</p>
                                        </button>
                                    </form>
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
    </div>
</nav>

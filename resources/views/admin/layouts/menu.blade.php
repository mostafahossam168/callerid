<div class="sidebar">
    <div class="tog-active d-none d-lg-block" data-tog="true" data-active=".app">
        <i class="fas fa-bars"></i>
    </div>
    <style>
        .main-badge {
            border-radius: 50%;
            display: flex;
            width: 20px;
            height: 20px;
            color: #fff;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            background: #ff3636;
            padding: 12px !important;
        }
    </style>
    <ul class="list">
        @can('الواجهة')
            <li class="list-item {{ request()->routeIs('admin.home') ? 'active' : '' }}">
                <a href="{{ route('admin.home') }}">
                    <div>
                        <i class="fa-solid fa-house-user icon"></i>
                        {{ __('home') }}
                    </div>
                </a>
            </li>
        @endcan
        <li class="list-item">
            <a target="_blank" href="{{ route('front.home') }}">
                <div>
                    <i class="fa-solid fa-desktop icon"></i>
                    {{ __('interface') }}
                </div>
            </a>
        </li>
        @can('read_settings')
            <li class="list-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <a href="{{ route('admin.settings') }}">
                    <div>
                        <i class="fas fa-cog"></i>
                        {{ __('settings') }}
                    </div>
                </a>
            </li>
        @endcan
        @if(setting()->whatsapp_status)
            <li class="list-item">
                <a data-bs-toggle="collapse" href="#message-library" aria-expanded="false">
                    <div>
                        <i class="fas fa-envelope-open-text icon"></i>
                        رسائل Whatsapp
                    </div>
                    <i class="fa-solid fa-angle-right arrow"></i>
                </a>
            </li>
            <div id="message-library" class="collapse item-collapse">
                <li class="list-item">
                    <a href="{{ route('admin.message_library.images') }}">
                        <div>
                            <i class="fas fa-envelope-open-text icon"></i>
                            مكتبه الرسايل المصورة
                        </div>
                    </a>
                </li>
                <li class="list-item">
                    <a href="{{ route('admin.message_library.texts') }}">
                        <div>
                            <i class="fas fa-envelope-open-text icon"></i>
                            مكتبه الرسايل النصية
                        </div>
                    </a>
                </li>
                <li class="list-item">
                    <a href="{{ route('admin.message_library.send_message') }}">
                        <div>
                            <i class="fas fa-envelope-open-text icon"></i>
                            ارسال رسالة
                        </div>
                    </a>
                </li>
                <li class="list-item">
                    <a href="{{ route('admin.message_library.send_message_settings') }}">
                        <div>
                            <i class="fas fa-envelope-open-text icon"></i>
                            اعدادات الرسائل
                        </div>
                    </a>
                </li>

            </div>
        @endif


        @can('read_groups')
            <li class="list-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                <a href="{{ route('admin.roles.index') }}">
                    <div>
                        <i class="fas fa-chart-bar"></i>
                        {{ __('groups') }}
                    </div>
                </a>
            </li>
        @endcan
        {{-- <li class="list-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}">
                <div>
                    <i class="fa-solid fa-puzzle-piece"></i>
                    {{ __('admin.maincategories') }}
                </div>
            </a>
        </li> --}}
        <li class="list-item {{ request()->routeIs('admin.notifications.index') ? 'active' : '' }}">
            <a href="{{ route('admin.notifications.index') }}">
                <div>
                    <i class="fa-solid fa-bell"></i>
                    {{ __('admin.Notifications') }}
                </div>
                <div
                    class="main-badge">{{ App\Models\Notification::count() }}</div>
            </a>
        </li>


        <li class="list-item {{ request()->routeIs('admin.strains.*') ? 'active' : '' }}">
            <a href="{{ route('admin.strains.index') }}">
                <div>
                    <i class="fa-solid fa-cat"></i>
                    السلالات
                </div>
            </a>
        </li>
        <li class="list-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}">
                <div>
                    <i class="fa-solid fa-cow"></i>
                    انواع الحيوانات
                </div>
            </a>
        </li>
        {{--
                <li class="list-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.departments.index') }}">
                        <div>
                            <i class="fa-solid fa-puzzle-piece"></i>
                            {{ __('admin.departments') }}
                        </div>
                    </a>
                </li> --}}
        @can('read_employees')
            <li class="list-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}">
                    <div>
                        <i class="fa-solid fa-user-tie"></i> {{ __('admin.users') }}
                    </div>
                </a>
            </li>
        @endcan

        <li class="list-item {{ request()->routeIs('admin.departments.*') ? 'active' : '' }}">
            <a href="{{ route('admin.departments.index') }}">
                <div>
                    <i class="fa-solid fa-building-wheat"></i>
                    {{ __('admin.departments') }}
                </div>
            </a>
        </li>

        {{--        <li class="list-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">--}}
        {{--            <a data-bs-toggle="collapse" href="#collapse-1" aria-expanded="false">--}}
        {{--                <div>--}}
        {{--                    <i class="fa-solid fa-hospital-user"></i>--}}
        {{--                    {{ __('admin.patients') }}--}}
        {{--                </div>--}}
        {{--                <i class="fa-solid fa-angle-right arrow"></i>--}}
        {{--            </a>--}}
        {{--        </li>--}}

        {{--        <div class="collapse item-collapse" id="collapse-1">--}}
        {{--            @can('read_patients')--}}

        {{--                <li class="list-item">--}}
        {{--                    <a href="{{ route('admin.patients.index') }}">--}}
        {{--                        <div>--}}
        {{--                            <i class="fa-solid fa-hospital-user icon"></i>{{ __('admin.patients') }}--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                </li>--}}
        {{--            @endcan--}}

        {{--            <li class="list-item {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">--}}
        {{--                <a href="{{ route('admin.countries.index') }}">--}}
        {{--                    <div>--}}
        {{--                        <i class="fa-solid fa-address-card icon"></i> {{ __('admin.countries') }}--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--            <li class="list-item {{ request()->routeIs('admin.relationships.*') ? 'active' : '' }}">--}}
        {{--                <a href="{{ route('admin.relationships.index') }}">--}}
        {{--                    <div>--}}
        {{--                        <i class="fa-solid fa-users icon"></i> {{ __('admin.relationships') }}--}}
        {{--                    </div>--}}
        {{--                </a>--}}
        {{--            </li>--}}
        {{--            @can('read_diagnoses')--}}

        {{--                <li class="list-item {{ request()->routeIs('admin.diagnoses.*') ? 'active' : '' }}">--}}
        {{--                    <a href="{{ route('admin.diagnoses.index') }}">--}}
        {{--                        <div>--}}
        {{--                            <i class="fa-solid fa-comment-medical icon"></i> {{ __('admin.Diagnoses') }}--}}
        {{--                        </div>--}}
        {{--                    </a>--}}
        {{--                </li>--}}
        {{--        </div>--}}
        {{--        @endcan--}}
        @can('read_forms')
            <li class="list-item {{ request()->routeIs('admin.forms.*') ? 'active' : '' }}">
                <a href="{{ route('admin.forms.index') }}">
                    <div>
                        <i class="fa-solid fa-file-signature icon"></i>
                        {{ __('admin.Forms') }}
                    </div>
                </a>
            </li>
        @endcan
        {{-- @can('read_appointments')
            <li class="list-item {{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                <a href="{{ route('admin.appointments.index') }}">
                    <div>
                        <i class="fa-solid fa-calendar-days icon"></i>
                        {{ __('admin.appointments') }}
                    </div>
                </a>
            </li>
        @endcan
        @can('read_invoices')
            <li class="list-item {{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                <a href="{{ route('admin.invoices.index') }}">
                    <div>
                        <i class="fa-solid fa-file-invoice-dollar icon"></i>
                        {{ __('admin.invoices') }}
                    </div>
                </a>
            </li>
        @endcan --}}
        @can('read_products')
            <li class="list-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">
                    <div>
                        <i class="fa-solid fa-handshake-angle icon"></i>
                        {{ __('admin.Products') }}
                    </div>
                </a>
            </li>
        @endcan
        <li class="list-item {{ request()->routeIs('admin.insurances.*') ? 'active' : '' }}">
            <a href="{{ route('admin.insurances.index') }}">
                <div>
                    <i class="fa-solid fa-building icon"></i>
                    {{ __('admin.insurances') }}
                </div>
            </a>
        </li>
        @can('read_kinds')
            <li class="list-item {{ request()->routeIs('admin.kinds.*') ? 'active' : '' }}">
                <a href="{{ route('admin.kinds') }}">
                    <div>
                        <i class="fa-solid fa-building icon"></i>الأصناف
                    </div>
                </a>
            </li>
        @endcan

        {{-- @can('المخازن')
            <li class="list-item {{ request()->routeIs('admin.stores.*') ? 'active' : '' }}">
        <a href="{{ route('admin.stores') }}">
            <div>
                <i class="fa-solid fa-building"></i>المخازن
            </div>
        </a>
        </li>
        @endcan --}}


        @can('read_supplies')
            <li class="list-item {{ request()->routeIs('admin.supplies.*') ? 'active' : '' }}">
                <a href="{{ route('admin.supplies') }}">
                    <div><i class="fa-solid fa-building icon"></i>المواد</div>
                </a>
            </li>
        @endcan


        <li class="list-item {{ request()->routeIs('admin.sms.*') ? 'active' : '' }}">
            <a href="{{ route('admin.sms.index') }}">
                <div>
                    <i class="fa-solid fa-building icon"></i>رسائل التذكير
                </div>
            </a>
        </li>

        <li class="list-item {{ request()->routeIs('admin.faqs') ? 'active' : '' }}">
            <a href="{{ route('admin.faqs') }}">
                <div>
                    <i class="fa-solid fa-building icon"></i>الأسئلة الشائعة
                </div>
            </a>
        </li>
        <li class="list-item">
            <a href="{{ route('analysisLab') }}">
                <div>
                    <i class="fa-solid fa-notes-medical"></i>معمل التحاليل
                </div>
            </a>
        </li>


        {{-- <li class="list-item {{ request()->routeIs('admin.questions.*') ? 'active' : '' }}">
        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <div>
                <i class="fa-solid fa-hospital-user"></i>
                الاستبيانات
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu dropdown-menu-dark">
            <li>
                <a href="{{ route('admin.submits.index') }}" class="drop-fs">
                    <div>
                        <i class="fa-solid fa-hospital-user"></i>كل الاستبيانات
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.questions.index') }}" class="drop-fs">
                    <div><i class="fa-solid fa-hospital-user"></i>الأسئلة</div>
                </a>
            </li>
        </ul>
        </li> --}}

    </ul>
</div>

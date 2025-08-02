<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', setting()->site_name)</title>
    <!-- Normalize -->
    <link rel="stylesheet" href="{{ asset('/css/normalize.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}" />
    <!-- Main Faile Css  -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}" />
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
        integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('human-body-assets/css/main.css') }}" />
    @livewireStyles
    @stack('css')
</head>

<body>

    <!-- start scroll top button -->
    <div class="up-btn position-fixed rounded-3 text-white not-print">
        <i class="up-ar fa-solid fa-angles-up"></i>
        <i class="tooth-icon fa-solid fa-shield-dog"></i>
    </div>
    <!-- end scroll top button -->

    <!-- Start Loader -->
    <div class='loader-container position-fixed w-100 vh-100'>
        <img src="{{ asset('img/loading.gif') }}" alt="loader-img" class="the_loader">
    </div>
    <!-- End Loader -->

    <!-- Start Top Nav Bar -->
    <nav class="top-nav not-print">
        <div class="container justify-content-between justify-content-md-end   py-2">
            <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
            <ul class="list-item notification">
                @can('read_notifications')
                    <li>
                        <a class="item" href="{{ route('doctor.notifications') }}">
                            <i class="i-item fa-solid fa-bell"></i>
                            <div class="badge-count">
                                {{ App\Models\Notification::where('user_id', auth()->user()->id)->whereNull('seen_at')->count() }}
                            </div>
                        </a>
                    </li>
                @endcan
            </ul>
            <div class="dropdown-hover" data-show="dropdown-lang">
                <div class="icon-drop">
                    <i class="fa-solid fa-user icon"></i>
                </div>
                <p class="text">{{ doctor()?->name }}</p>
                <div class="arrow-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <ul class="listis-item" id="dropdown-lang">
                    <li class="item-drop">
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf
                        </form>
                        <button class="border-0" form="logout-form">
                            <p class="text">{{ __('log out') }}</p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Top Nav Bar -->

    <!-- Start Bottom Nav Bar -->
    <nav class="bottom-nav not-print">
        <div class="container">
            <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>
            <div class="d-flex justify-content-between align-items-center">
                <ul class="list-item">
                    <li>
                        <a class="item" href="{{ url('doctor') }}">
                            {{ __('home') }}
                            <i class="i-item fa-solid fa-house"></i>
                        </a>
                    </li>
                    <li>
                        <a class="item" href="{{ route('doctor.interface') }}">
                            {{ __('doctor interface') }}
                            <i class="i-item fa-solid fa-stethoscope"></i>
                        </a>
                    </li>
                    <li>
                        <a class="item" href="{{ route('doctor.diagnoses.index') }}">
                            {{ __('Diagnoses') }}
                            <i class="i-item fa-solid fa-stethoscope"></i>
                        </a>
                    </li>
                    @can('read_patients')
                        <li>
                            <a class="item" href="{{ route('doctor.patients.index') }}">
                                {{ __('admin.patients') }}
                                <i class="i-item fa-solid fa-users"></i>
                            </a>
                        </li>
                    @endcan
                    @can('read_appointments')
                        <li>
                            <a class="item" href="{{ route('doctor.appointments') }}">
                                {{ __('Appointments') }}
                                <i class="i-item fa-solid fa-calendar-days"></i>
                            </a>
                        </li>
                    @endcan

                    @can('read_invoices')
                        <li>
                            <a class="item" href="{{ route('doctor.invoices.index') }}">
                                {{ __('Invoices') }}
                                <i class="i-item fa-solid fa-file-invoice-dollar"></i>
                            </a>
                        </li>
                    @endcan
                    @can('read_products')
                        <li>
                            <a class="item" href="{{ route('doctor.products.index') }}">
                                {{ __('admin.items') }}
                                <i class="i-item fa-solid fa-handshake-angle"></i>
                            </a>
                        </li>
                    @endcan
                    @can('read_products')
                        <li>
                            <a class="item" href="{{ route('front.items') }}">
                                @lang('admin.Products')
                                <i class="i-item fa-solid fa-handshake-angle"></i>
                            </a>
                        </li>
                    @endcan
                    {{-- <li>
                        <a class="item" href="{{ route('doctor.diagnose_keywords') }}">
                            الكلمات الدلالية للتشخيص
                            <i class="i-item fa-solid fa-calendar-days"></i>
                        </a>
                    </li> --}}

                    @can('read_reports')
                        <li>
                            <a class="item" href="{{ route('doctor.report') }}">
                                {{ __('Reports') }}
                                <i class="i-item fa-solid fa-file-invoice"></i>
                            </a>
                        </li>
                    @endcan
                    @can('read_appointments')
                        <li>
                            <a class="item" href="{{ route('doctor.appointments', ['app_day' => 'today']) }}">
                                {{ __('Today appointments') }}
                                <i class="i-item fa-solid fa-hospital-user"></i>
                                <div class="badge-count">
                                    {{ App\Models\Appointment::where('doctor_id', auth()->id())->where('appointment_status', 'pending')->where('appointment_date', date('Y-m-d'))->count() }}
                                </div>
                            </a>
                        </li>
                    @endcan
                </ul>
                <ul class="list-item">
                    @if (app()->getLocale() == 'ar')
                        <li>
                            <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('en') }}"> <i
                                    class="fa-solid fa-language"></i></a>
                        </li>
                    @else
                        <li>
                            <a class="lang me-2" href="{{ LaravelLocalization::getLocalizedURL('ar') }}"> <i
                                    class="fa-solid fa-language"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Bottom Nav Bar -->
    <!-- start main section -->
    <section class="main-section py-5">
        <x-message-admin />
        @yield('content')
    </section>
    <!-- end main section -->
    <!-- Start Footer -->
    <div class="footer-bottom py-3 not-print">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <p>{{ __('All rights reserved © 2022') }}</p>
                <div class="about_data d-flex align-items-center justify-content-center">
                    <p class="ms-2">{{ __('C Program - Medical Clinic Management 0.0.1') }}</p>
                    <img class="alt_image" src="{{ asset('img/footer/doc.png') }}" alt="image">
                </div>
                <a href="https://www.const-tech.org/">
                    <img src="{{ asset('img/footer/copy.png') }}" alt="logo">
                </a>
            </div>
        </div>
    </div>
    <!-- ENd Footer -->
    <!-- Js Files -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/all.min.js') }}"></script>
    <script src="{{ asset('human-body-assets/js/main.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js') }}/sweetalert2.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert', ({
            detail: {
                type,
                message
            }
        }) => {
            Toast.fire({
                timer: 10000,
                icon: type,
                title: message
            })
        })
    </script>
    @if (session()->has('success'))
        <script>
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            })
        </script>
    @endif

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(function() {
            function matchStart(params, data) {
                // If there are no search terms, return all of the data
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip if there is no 'children' property
                if (typeof data.children === 'undefined') {
                    return null;
                }

                // `data.children` contains the actual options that we are matching against
                var filteredChildren = [];
                $.each(data.children, function(idx, child) {
                    if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
                        filteredChildren.push(child);
                    }
                });

                // If we matched any of the timezone group's children, then set the matched children on the group
                // and return the group object
                if (filteredChildren.length) {
                    var modifiedData = $.extend({}, data, true);
                    modifiedData.children = filteredChildren;

                    // You can return modified objects from here
                    // This includes matching the `children` how you want in nested data sets
                    return modifiedData;
                }

                // Return `null` if the term should not be displayed
                return null;
            }

            $(".select2").select2({
                cure: true,
                closeOnSelect: false,
                minimumResultsForSearch: Infinity,
                matcher: matchStart
            });
        });
    </script>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @if (auth()->check())
        <script>
            var pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
            });

            var channel = pusher.subscribe('new-notification-{{ auth()->id() }}');
            channel.bind('new-notification', function(data) {
                // app.messages.push(JSON.stringify(data));
                Swal.fire({
                    title: data.notification.title,
                    icon: 'info',
                    html: "<a class='btn btn-success text-nowrap' href='{{ route('doctor.notifications') }}'>عرض الاشعارات</a>",
                    showConfirmButton: false,
                    position: 'center',
                    padding: '13px',
                    customClass: 'swal-alert-info',
                    showCloseButton: false,
                    showCancelButton: false,
                    focusConfirm: false,
                })
            });
        </script>
    @endif

    <script>
        $(function() {
            jQuery("[name=select_all]").click(function(source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('#btn_delete_all').click(function() {
                var selected = [];
                $("input:checkbox[name=delete_select]:checked").each(function() {
                    selected.push($(this).val());
                });
                if (selected.length > 0) {
                    $('#bulkdeleteall').modal('show');
                    $('input[id="delete_all"]').val(selected);
                } else {
                    swal({
                        title: "Oops!",
                        text: "Please select at least one record",
                        icon: "error",
                        button: "OK",
                    });
                }
            });
        });
    </script>

    @livewireScripts

    @stack('js')
</body>

</html>

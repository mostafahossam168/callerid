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
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('human-body-assets/css/main.css') }}" />
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
                <li>
                    <a class="item" href="{{ route('doctor.notifications') }}">
                        <i class="i-item fa-solid fa-bell"></i>
                        <div class="badge-count">
                            0
                        </div>
                    </a>
                </li>
            </ul>
            <div class="dropdown-hover" data-show="dropdown-lang">
                <div class="icon-drop">
                    <i class="fa-solid fa-user icon"></i>
                </div>
                <p class="text">اسم</p>
                <div class="arrow-icon">
                    <i class="fa-solid fa-angle-down"></i>
                </div>
                <ul class="listis-item" id="dropdown-lang">
                    <li class="item-drop">
                        <form id="logout-form" method="POST" action="">
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
            <ul class="list-item">
                <li>
                    <a class="item" href="">
                        {{ __('home') }}
                        <i class="i-item fa-solid fa-house"></i>
                    </a>
                </li>
            </ul>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ asset('js') }}/sweetalert2.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @stack('js')
</body>

</html>
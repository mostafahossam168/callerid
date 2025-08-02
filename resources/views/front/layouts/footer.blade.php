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
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<!-- Sweer Alert -->
<script src="{{ asset('js') }}/sweetalert2.js"></script>

{{--  --}}




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
            icon: type,
            title: message
        })
    })
</script>

<!-- Chart Js -->
<script src="{{ asset('js') }}/chart.js"></script>
<script>
    if (document.querySelector("#myChartDate")) {
        let xValues = ["January", "February", "March ", "April", "may", "June", "July", "August ", "September",
            "September", "October", "November", "December"
        ];
        new Chart("myChartDate", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1070, 1070, 1070, 1110, 1330, 2210, 7830, 2478],
                    borderWidth: "1px",
                    pointRadius: 0,
                    borderColor: "#4B94BF",
                    backgroundColor: "rgba(75, 148, 191, 0.7)",
                    fill: true
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 5000, 6000, 1900, 1900, 1900,
                        7000
                    ],
                    borderColor: "rgba(210 ,214, 223, 1)",
                    borderWidth: "1px",
                    backgroundColor: "rgba(210 ,214, 223, 0.7)",
                    pointRadius: 0,
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    }
</script>

<!--select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- bootstrap Tooltip -->
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>


<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
@if (auth()->check())
    <script>
        // Enable pusher logging - don't include this in production

        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        var channel = pusher.subscribe('new-notification-{{ auth()->id() }}');
        channel.bind('new-notification', function(data) {
            // app.messages.push(JSON.stringify(data));
            Swal.fire({
                title: data.notification.title,
                icon: 'info',
                html: "<a class='btn btn-success text-nowrap' href='{{ route('front.notifications') }}'>عرض الاشعارات</a>",
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


@livewireScripts
@stack('js')
</body>

</html>

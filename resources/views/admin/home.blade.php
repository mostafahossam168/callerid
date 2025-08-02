@extends('admin.layouts.admin')

@section('content')
<div class="main-side">
    <div class="main-title">
        <div class="small">
            @lang('Home')
        </div>
        <div class="large">
            @lang('admin.Dashboard')
        </div>
    </div>
    <div class="row g-3 mb-2">
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Clients')</h6>
                    <h3 class="amount"><span class="num-stat" data-goal="{{\App\Models\User::where('type','client')->count()}}">0</span></h3>
                    <a href="{{route('admin.clients')}}" class="link-view">@lang('admin.View all clients')</a>
                </div>
                <div class="left-side">
                    <p class="status-number up"> </i></p>
                    <div class="icon-holder green">
                        <i class="fa-regular fa-circle-user"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic blue">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Vendors')</h6>
                    <h3 class="amount"><span class="num-stat" data-goal="{{\App\Models\User::where('type','vendor')->count()}}">0</span></h3>
                    <a href="{{route('admin.vendors.index')}}" class="link-view">@lang('admin.View all Vendors')</a>
                </div>
                <div class="left-side">
                    <p class="status-number down"></i></p>
                    <div class="icon-holder blue">
                        <i class="fa-solid fa-user-tie"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic purple">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Sections')</h6>
                    <h3 class="amount num-stat" data-goal="{{\App\Models\Category::count()}}">0</h3>
                    <a href="{{route('admin.categories')}}" class="link-view">@lang('admin.Show all sections')</a>
                </div>
                <div class="left-side">
                    <p class="status-number up"> </i></p>
                    <div class="icon-holder yellow">
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 col-xl-3">
            <div class="box-statistic green">
                <div class="right-side">
                    <h6 class="name">@lang('admin.Products')</h6>
                    <h3 class="amount"><span class="num-stat" data-goal="{{\App\Models\Product::count()}}">0</span></h3>
                    <a href="#" class="link-view">@lang('admin.Show all products')</a>
                </div>
                <div class="left-side">
                    <p class="status-number"></p>
                    <div class="icon-holder">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12">
            <div class="row g-3">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-header bg-white">
                            @lang('admin.Profit')
                        </div>
                        <div class="card-body">
                            <canvas class="w-100" id="myChartDate" height="160"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="box-statistic yellow">
                                <div class="right-side">
                                    <h6 class="name">@lang('admin.Articles')</h6>
                                    <h3 class="amount num-stat" data-goal="{{\App\Models\ContactUs::count()}}">0</h3>
                                    <a href="{{route('admin.categories')}}" class="link-view">@lang('admin.View all articles')</a>
                                </div>
                                <div class="left-side">
                                    <p class="status-number up"> </p>
                                    <div class="icon-holder green">
                                        <i class="fa-regular fa-newspaper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="box-statistic ">
                                <div class="right-side">
                                    <h6 class="name">@lang('admin.Groups')</h6>
                                    <h3 class="amount num-stat" data-goal="{{\App\Models\Program::count()}}">0</h3>
                                    <a href="#" class="link-view">@lang('admin.View all groups')</a>
                                </div>
                                <div class="left-side">
                                    <p class="status-number up"></p>
                                    <div class="icon-holder blue">
                                        <i class="fa-solid fa-bars-progress"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="box-statistic blue">
                                <div class="right-side">
                                    <h6 class="name">@lang('admin.Technical support')</h6>
                                    <h3 class="amount num-stat" data-goal="{{\App\Models\Ticket::count()}}">0</h3>
                                    <a href="{{route('admin.tickets.index')}}" class="link-view">@lang('admin.View support messages')</a>
                                </div>
                                <div class="left-side">
                                    <p class="status-number"> </p>
                                    <div class="icon-holder">
                                        <i class="fa-solid fa-headset"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="box-statistic purple">
                                <div class="right-side">
                                    <h6 class="name">@lang('admin.Contact Us')</h6>
                                    <h3 class="amount num-stat" data-goal="{{\App\Models\ContactUs::count()}}">0</h3>
                                    <a href="{{route('admin.contactes')}}" class="link-view">@lang('admin.View communication messages')</a>
                                </div>
                                <div class="left-side">
                                    <p class="status-number up"></p>
                                    <div class="icon-holder yellow">
                                        <i class="fa-solid fa-handshake-angle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    let xValues = ["January", "February", "March", "April", "May", "June", "July"];
    new Chart("myChartDate", {
        type: "bar", // الرسم البياني من نوع الأعمدة
        data: {
            labels: xValues,
            datasets: [
                {
                    type: 'line',
                    label: 'مزودين الخدمة',
                    data: [0, 50, 500, 200, 400, 300, 100],
                    borderWidth: 2,
                    pointRadius: 1,
                    borderColor: "#405189",
                    backgroundColor: "rgb(64 81 137 / 10%)",
                    fill: true
                },
                {
                    label: 'العملاء',
                    data: [100, 200, 700, 800, 500, 600, 300],
                    type: 'line',
                    borderWidth: 2,
                    pointRadius: 1,
                    borderColor: "#f06548",
                    fill: true
                }
            ],
            options: {
                responsive: true,
                legend: {
                    display: true
                },
                tooltips: {
                    mode: 'index',
                    intersect: false
                },
                hover: {
                    mode: 'index',
                    intersect: false
                }
            }
        },
    });


    if (document.querySelectorAll(".num-stat")) {
        let numStats = document.querySelectorAll(".num-stat");
        let started = false;
        document.addEventListener("DOMContentLoaded", function() {
            numStats.forEach((num) => startCount(num));
        });

        function startCount(el) {
            let goal = el.dataset.goal;
            let duration = 2000; // تحديد المدة الزمنية
            let start = null;

            function updateCount(timestamp) {
                if (!start) start = timestamp;
                let progress = timestamp - start;
                let increment = Math.floor((progress / duration) * goal);
                el.textContent = increment > goal ? goal : increment;
                if (progress < duration) {
                    requestAnimationFrame(updateCount);
                }
            }
            requestAnimationFrame(updateCount);
        }
    }
</script>
@endpush
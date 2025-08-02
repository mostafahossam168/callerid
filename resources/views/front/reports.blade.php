@extends('front.layouts.front')
@section('title')
    {{ __('Accounting and reports') }}
@endsection
@section('content')
    <section class="main-section notice">
        <div class="container">
            <h4 class="main-heading">{{ __('Accounting and reports') }}</h4>
            @include('front.layouts.accounting-menu')
            <div class="bg-white p-3 rounded-2 shadow">
                <div class="row g-3">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.Clidoc_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('clinic and the doctor') }}</p>
                                <img src="{{ asset('img/report-2.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ url('/treasury') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Treasury report') }}</p>
                                <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.Financial_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('General account statement') }}</p>
                                <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.purchases_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Procurement report') }}</p>
                                <img src="{{ asset('img/report-6.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.expenses.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Expenses') }}</p>
                                <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.insurances_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Insurance companies') }}</p>
                                <img src="{{ asset('img/report-5.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.reception_staff_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('reception staff') }}</p>
                                <img src="{{ asset('img/report-4.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.patient_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Patient report') }}</p>
                                <img src="{{ asset('img/report-3.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.queue_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Queue report') }}</p>
                                <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.salaries.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Salary report') }}</p>
                                <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.expenses_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Expense report') }}</p>
                                <img src="{{ asset('img/report-1.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.animals_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.animal_reports') }}</p>
                                <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.hotel_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">تقرير الفندقة</p>
                                <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.sales_report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Sales report') }}</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.purchases.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Purchases') }}</p>
                                <img src="{{ asset('img/report-2.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.strains') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Types of breeds') }}</p>
                                <img src="{{ asset('img/animal-icon.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.products_and_items') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('admin.Products and items') }}</p>
                                <img src="{{ asset('img/report-11.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

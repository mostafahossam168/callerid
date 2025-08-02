@extends('front.layouts.front')
@section('title')
    {{ __('Accounting') }}
@endsection
@section('content')
    @php
        $years = [
            now()->subYears(3)->format('Y'),
            now()->subYears(2)->format('Y'),
            now()->subYears(1)->format('Y'),
            now()->format('Y'),
            now()->addYears(1)->format('Y'),
            now()->addYears(2)->format('Y'),
        ];
    @endphp
    <section class="main-section notice">
        <div class="container">
            <h4 class="main-heading">{{ __('Accounting') }}</h4>
            @include('front.layouts.accounting-menu')

            <div class="bg-white p-3 rounded-2 shadow">
                <form action="{{ route('front.accountring_year_save') }}" method="POST" id="accounting_year_form">
                    @csrf
                    <div class="form-group">
                        <label for="">@lang('Select the year')</label>
                        <select name="accounting_year" onchange="document.getElementById('accounting_year_form').submit()"
                            class="form-control" id="accounting_year">
                            @foreach ($years as $year)
                                <option
                                    {{ cache('accounting_year') ? (cache('accounting_year') == $year ? 'selected' : '') : ($year == now()->format('Y') ? 'selected' : '') }}
                                    value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="bg-white p-3 rounded-2 shadow">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.accounts-tree') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Accounting tree') }}</p>
                                <img src="{{ asset('img/money-tree.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.vouchers.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Daily restrictions') }}</p>
                                <img src="{{ asset('img/report-9.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.account-statement') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Account statement') }}</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    {{-- <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.cost_center.report') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Cost center') }}</p>
                                <img src="{{ asset('img/report-6.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div> --}}
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.tax.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Tax declaration') }}</p>
                                <img src="{{ asset('img/report-8.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.bank-accounts.index') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">@lang('Bank account')</p>
                                <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.review') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">@lang('Trial Balance')</p>
                                <img src="{{ asset('img/report-10.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.reception-restrictions') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">{{ __('Daily reception restrictions') }}</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.vouchers.payment_voucher') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">سند صرف</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <a href="{{ route('front.cost_centers') }}" class="translate">
                            <div class="box-report">
                                <p class="mb-0">مراكز التكلفة</p>
                                <img src="{{ asset('img/report-7.png') }}" alt="report img" class="report-img">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

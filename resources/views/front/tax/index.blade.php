@extends('front.layouts.front')
@section('title')
{{ __('Tax declaration') }}
@endsection
@section('content')
<section class="tax-section main-section pt-5">
    <div class="container">
        <div id="prt-content" class="tax-content bg-white p-4 rounded-2 shadow data-print">
        <div class="d-flex mb-3">
            <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
        <h4 class="main-heading">{{ __('Tax declaration') }}</h4>
            <div class="row not-print mb-3">
                <div class="left-holder d-flex justify-content-end gap-2 m-sm-0 ">
                    <button class="btn btn-sm btn-outline-info" id="export-btn">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                    <button class="btn btn-sm btn-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
                {{-- <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-from" class="report-name mt-3 mb-2">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="box-info">
                        <label for="duration-to" class="report-name mt-3 mb-2">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="box-info">
                            <label for="duration-to" class="report-name mt-3 mb-2 fs-12px">الربع المالي الاول من
                                العام</label>
                            <input type="date" class="form-control" wire:model="to" id="duration-to" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="box-info">
                            <label for="duration-to" class="report-name mt-3 mb-2 fs-12px">الربع المالي الثاني من
                                العام</label>
                            <input type="date" class="form-control" wire:model="to" id="duration-to" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="box-info">
                            <label for="duration-to" class="report-name mt-3 mb-2 fs-12px">الربع المالي الثالث من
                                العام</label>
                            <input type="date" class="form-control" wire:model="to" id="duration-to" />
                        </div>
                    </div>
                    <div class="col-12 col-md-2">
                        <div class="box-info">
                            <label for="duration-to" class="report-name mt-3 mb-2 fs-12px">الربع المالي الرابع من
                                العام</label>
                            <input type="date" class="form-control" wire:model="to" id="duration-to" />
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- <hr> -->

            {{-- @dump($dates,$results,$pResults,$totals) --}}
                @foreach ($dates as $key => $date)
                <div class="box-tax mb-1 {{$key == 1 ? 'purple' : ($key == 2 ? 'success':($key == 3 ? 'orange':''))}}">
                    الربع
                    @if($key == 0)
                    الأول
                    @elseif ($key == 1)
                    الثاني
                    @elseif ($key == 2)
                    الثالث
                    @elseif ($key == 3)
                    الرابع
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table main-table mb-3" id="data-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>البيان</th>
                                <th>الاشهر</th>
                                <th>من تاريخ</th>
                                <th>الي تاريخ</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $date['name'] }}</td>
                                <td>{{ $date['months'] }}</td>
                                <td>{{ $date['start'] }}</td>
                                <td>{{ $date['end'] }}</td>
                            </tr>

                        </tbody>
                    </table>

                </div>
                <div class="row g-1 mb-4 print-mb">
                    <div class="col-12 col-sm-6">
                        <div class="table-title fw-bold fs-13px text-center">
                            المشتريات الخاصة للضريبة الاساسية
                        </div>
                        <div class="table-responsive mt-1">
                            <table class="table main-table m-0" id="data-table">
                                <thead>
                                    <tr>
                                        <th>البيان</th>
                                        <th>{{ __('department.net_sum') }}</th>
                                        <th>{{ __('department.total_sum') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td style="background-color:#f9fafb" class="border">قيمة المشتريات</td>
                                        <td class="border">{{ isset($pResults[$key]['amount']) ? $pResults[$key]['amount'] :
                                            0 }}</td>
                                        <td class="border"> {{ isset($pResults[$key]['total']) ? $pResults[$key]['total'] :
                                            0 }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color:#f9fafb" class="border">اجمالي المشتريات</td>
                                        <td class="border">{{ isset($pResults[$key]['amount']) ? $pResults[$key]['amount'] :
                                            0 }}</td>
                                        <td class="border"> {{ isset($pResults[$key]['total']) ? $pResults[$key]['total'] :
                                            0 }}</td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="table-title fw-bold fs-13px text-center">
                            المبيعات الخاصة للضريبة الاساسية
                        </div>
                        <div class="table-responsive mt-1">
                            <table class="table main-table m-0" id="data-table">
                                <thead>
                                    <tr>
                                        <th>البيان</th>
                                        <th>{{ __('department.net_sum') }}</th>
                                        <th>{{ __('department.total_sum') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td style="background-color:#f9fafb" class="border">قيمة المبيعات</td>
                                        <td class="border">{{ isset($results[$key]['amount']) ? $results[$key]['amount'] : 0
                                            }}</td>
                                        <td class="border"> {{ isset($results[$key]['total']) ? $results[$key]['total'] : 0
                                            }}</td>
                                    </tr>
                                    <tr>
                                        <td style="background-color:#f9fafb" class="border">اجمالي المبيعات</td>
                                        <td class="border">{{ isset($results[$key]['amount']) ? $results[$key]['amount'] : 0
                                            }}</td>
                                        <td class="border"> {{ isset($results[$key]['total']) ? $results[$key]['total'] : 0
                                            }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table main-table m-0" id="data-table">
                            <tbody>
                                <tr>
                                    <td style="background-color:#f9fafb ;color:#6b7280" class="border fw-bold">المجموع الكلى
                                        بعد الضريبه</td>
                                    <td class="border">{{ $totals['total'] }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#f9fafb;color:#6b7280" class="border fw-bold">المجموع الكلى
                                        قبل الضريبه</td>
                                    <td class="border">{{ $totals['amount'] }}</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#f9fafb;color:#6b7280" class="border fw-bold">مجموع الضريبة
                                    </td>
                                    <td class="border">{{ $totals['tax'] }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
        </div>
    </div>
</section>
@endsection

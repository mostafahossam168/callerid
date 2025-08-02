@extends('front.layouts.front')
@section('title')
{{ $show->description }}
@endsection
@section('content')

<div class="modal fade" id="notEquals" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger">
                    تحذير : هذا القيد غير متوازن
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">حسناً</button>
                <a class="btn btn-dark btn-sm" href="{{ route('front.vouchers.edit',$voucher->id) }}">تعديل القيد</a>
            </div>

        </div>

    </div>
</div>


<section id="app" class="main-section">
    <div class="container">
        <div class="d-flex align-items-center gap-2 mb-3">
            <a href="{{ $voucher->invoice_id ? route('front.reception-restrictions') : route('front.vouchers.index') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading mb-0">
                قيد يومى
            </h4>
        </div>
        <x-message-admin></x-message-admin>
        {{-- @dump($accounts)  --}}
        {{-- New Items here  --}}
        <div class="bg-white shadow p-4 rounded-3" id="prt-content">
            <div class="box-invoice">
                <div class="row">
                    <div class="col-md-4 p-3">
                        <p>
                            <b> {{ setting()->site_name }} </b>
                        </p>
                        <p>
                            <b> {{ setting()->address }} - {{ setting()->build_num ? 'رقم المبني : ' . setting()->build_num : '' }} - {{ setting()->unit_num ? 'رقم الوحدة : ' . setting()->unit_num : '' }}</b>
                        </p>
                        <p><b>{{ setting()->phone }}</b></p>
                    </div>
                    <div class="text-center  col-md-4 p-3 d-flex align-items-center justify-content-center">
                        <img class="img-fluid" src="{{ display_file(setting()->logo) }}" alt="" width="130">
                    </div>
                    <div class="col-md-4 p-3">
                    </div>
                </div>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr class=" " style="border-bottom: 1px solid #f9fafb !important;">
                                <th>رقم السند : {{ $voucher->id }}</th>
                                <th>رقم المرجع: {{ $voucher->voucher_no }}</th>
                                <th>العملة: ريال سعودي</th>
                            </tr>
                            <tr class="">
                                <th>تاريخ السند:{{ $voucher->date }} </th>
                                <th></th>
                                <th>
                                    <div class="d-flex align-items-center">
                                        الوصف: <input type="text" value="{{ $voucher->description }}" readonly class="form-control">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>رقم الحساب</th>
                                <th>اسم الحساب</th>
                                <th>المدين</th>
                                <th>الدائن</th>
                               {{--  <th>مركز التكلفة</th> --}}
                                <th>الوصف</th>
                                <!-- <th class="text-center not-print">{{ __('admin.managers') }}</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if ($voucher->accounts)
                            @foreach ($voucher->accounts as $key => $account)
                            <tr>
                                <td>
                                    <input type="text" class="form-control" value="{{ $account->account?->id }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control" value="{{ $account->account?->name }}" readonly>
                                </td>
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                        <input value="{{ $account->debit }}" type="text" class="form-control" id="" readonly>
                                    </div>
                                </td>
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                        <input value="{{ $account->credit }}" type="text" class="form-control" id="" readonly>
                                    </div>
                                </td>

                               {{--  <td>
                                    <input value="{{ $account->branch?->name }}" type="text" class="form-control" id="" readonly>

                                </td> --}}
                                <td>
                                    <div dir="ltr" class="input-group mb-2 mb-md-0">
                                        <input value="{{ $account->description }}" type="text" class="form-control" id="" readonly>
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr>

                                <td>
                                    <input type="text" class="form-control" value="{{ $account->account2?->id }}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{{ $account->account2?->name }}" readonly>
                            </td>

                            <td>
                                <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                    <input value="{{ $account->debit2 }}" type="text" class="form-control" id="" readonly>
                                </div>
                            </td>
                            <td>
                                <div dir="ltr" class="input-group mb-2 mb-md-0 ">
                                    <input value="{{ $account->credit2 }}" type="text" class="form-control" id="" readonly>
                                </div>
                            </td>
                            <td>
                                <input value="{{ $account->branch?->name }}" type="text" class="form-control" id="" readonly>

                            </td>
                            <td>
                                <div dir="ltr" class="input-group mb-2 mb-md-0">
                                    <input value="{{ $account->description2 }}" type="text" class="form-control" id="" readonly>
                                </div>
                            </td>
                            </tr> --}}
                            @endforeach
                            @endif
                            <tr>
                                <td colspan="2" class="border">
                                    المجموع
                                </td>
                                <td class="border">
                                    {{ $voucher->accounts()->sum('debit') }}
                                </td>
                                <td class="border">
                                    {{ $voucher->accounts()->sum('credit') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table id="prt-content" class="table main-table">
                        <thead>
                            <tr class=" " style="border-bottom: 1px solid #f9fafb !important;">
                                <th class="pb-0">المحاسب</th>
                                <th class="pb-0">المراجع</th>
                                <th class="pb-0">المدير</th>
                            </tr>
                            <tr class="">
                                <th>--</th>
                                <th>--</th>
                                <th>--</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="d-flex justify-content-end not-print">
                    <div class="text-center">

                        <button type="button" class="btn btn-sm btn-warning" id="btn-prt-content">طباعة <i class="fas fa-print"></i></button>
                    </div>
                </div>
            </div>
        </div>
</section>
@push('js')
<x:pharaonic-select2::scripts />

@if($voucher->accounts()->sum('debit') != $voucher->accounts()->sum('credit'))
<script>
    var myModal = new bootstrap.Modal(document.getElementById("notEquals"), {});
    myModal.show();

</script>
@endif
@endpush

@endsection

@extends('front.layouts.front')
@section('title')
{{ __('Simplified tax invoice') }}
@endsection
@section('content')
    <section class="main-section">
        <div class="container-fluid">
            <div class="row bg-white p-md-3" id="prt-content">
                <div class="col-md-12">
                    <div class="mx-auto print-margin">
                        <h4 class="text-center mb-3 pt-3 pt-md-0">
                            {{ __('Simplified tax invoice') }}
                        </h4>
                        <div class="btn-holder not-print d-flex align-items-center justify-content-end gap-1 mb-3">
                            <button class="btn btn-danger text-white btn-sm">
                                <i class="fa-solid fa-download"></i> تنزيل PDF
                            </button>
                            <button id="btn-prt-content" class="btn btn-warning text-white btn-sm">
                                <i class="fa-solid fa-print"></i>
                            </button>
                        </div>
                        <div class="box-invoice">
                            <div class="row">
                                <div class="col-md-4 p-3 text-center text-md-end">
                                    <p><b>{{ setting()->site_name }} </b></p>
                                    <p><b>الرقم الضريبي: {{ setting()->tax_no }} </b></p>
                                    <p><b>الجوال: {{ setting()->phone }} </b></p>
                                    <p><b>العنوان: {{ setting()->address }}</b></p>
                                    <p><b>البريد الالكتروني: {{ setting()->email }}</b></p>
                                </div>
                                <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                                    <img class="img-fluid" src="{{ display_file(setting()->logo) }}" alt=""
                                        width="130" />
                                </div>
                                <div class="col-md-4 p-3 text-center text-md-end">
                                    <p><b>المالك: {{ $invoice->patient->name }}</b></p>
                                    <p><b>العنوان: {{ $invoice->patient->city?->name }}</b></p>
                                    <p><b>الجوال: {{ $invoice->patient->phone }}</b></p>
                                    <p><b> البريد الالكتروني: {{ $invoice->patient->email ?? 'لايوجد' }} </b></p>
                                </div>
                            </div>
                        </div>
                        <div class="scrl mb-3">
                            <table class="table table-invoice mb-2">
                                <thead>
                                    <tr>
                                        <th class="border-bottom">
                                            رقم الفاتورة - I.N
                                        </th>
                                        <th class="border-bottom">
                                            تاريخ الفاتورة - I.D
                                        </th>
                                        <th class="border-bottom">وقت الفاتورة - P.T</th>
                                        <th class="border-bottom">
                                            حالة الفاتورة - P.S
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-danger">{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $invoice->created_at->format('g:i') }}</td>
                                        <td>
                                            @if ($invoice->status == 'Paid')
                                                <span class="text-success">مسددة</span>
                                            @else
                                                <span class="text-danger">{{ __($invoice->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="scrl mb-3">
                            <table class="table table-invoice mb-2">
                                <tr>
                                    <th>منتج</th>
                                    <th>الكمية</th>

                                    <th>السعر</th>
                                    <th>قيمة الضريبة</th>
                                    <th>الإجمالي</th>
                                </tr>
                                @foreach ($invoice->products as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td><input type="text" value="{{ $item->quantity }}"
                                                class="form-control w-150px text-center w-sm mx-auto" disabled>

                                        </td>

                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->tax }}</td>
                                        <td>{{ $item->sub_total }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <label class="mb-1 small-heading d-block fw-normal text-white p-2 alt2-bg-color">@lang('admin.pet_info')</label>
                        <section class="scrl mb-3">
                            <table class="table table-invoice mb-2">
                                @foreach ($invoice->animals as $animal)
                                    <tr>
                                        <th>{{ __('admin.name') }}/ {{ $animal->name }}</th>
                                        <th>{{ __('admin.Pet Gender') }}/ {{ __($animal->gender) }}</th>
                                        <th>{{ __('admin.Pet Age') }}/ {{ $animal->age }}</th>
                                    </tr>
                                    <tr>
                                        <th colspan="2">نوع الأليف/ <input type="text" class="form-control w-auto d-inline-block" value="{{ $animal->type }}"></th>
                                        <th colspan="3">نوع السلالة/ <input type="text" class="form-control w-auto d-inline-block" value=" {{ $animal->breed_type }}"></th>
                                    </tr>
                                @endforeach
                            </table>
                        </section>
                        <div class="row g-4 mb-3 row-cols-1 row-cols-lg-2">
                            <div class="col">
                                <label
                                    class="mb-1 small-heading d-block fw-normal text-white p-2 alt2-bg-color">التشخيص</label>
                                @php
                                    //                                TODO
                                    $diagnose = \App\Models\Diagnose::where('dr_id', $invoice->dr_id)
                                        ->where('patient_id', $invoice->patient_id)
                                        ->latest()
                                        ->first();
                                @endphp
                                <textarea name="" class="form-control mb-2" style="min-height: 120px;">{{ $diagnose?->clinical_examination }}</textarea>
                            </div>
                            <div class="col">
                                <label class="mb-1 small-heading d-block fw-normal text-white p-2 alt2-bg-color">الخطة
                                    العلاجية والتوصيات الطبية"</label>
                                <textarea name="" class="form-control mb-2" style="min-height: 120px;">{{ $diagnose?->treatment_plan }}</textarea>
                            </div>
                        </div>


                        <div class="row flex-column-reverse flex-md-row">
                            <div class="col-md-4 mb-3 parent-barcode text-center d-flex align-items-center justify-content-center">
                                {!! $invoice->qr() !!}
                            </div>
                            <div class="col-md-8">
                                <table class="table table-invoice">
                                    <tbody>
                                        <tr>
                                            <td class="border-bottom td-head">
                                                <b> قيمة الضريبة ({{ setting()->tax_rate }}%) - Tax amount
                                                    ({{ setting()->tax_rate }}%) </b>
                                            </td>
                                            <td class="border-bottom">{{ $invoice->tax }}</td>
                                        </tr>
                                        <tr class="duble-border">
                                            <td class="td-head">
                                                <b>الاجمالي بعد الضريبة - Total after tax </b>
                                            </td>
                                            <td>{{ $invoice->total }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom td-head">
                                                <b> المدفوع - Paid up</b>
                                            </td>
                                            <td class="border-bottom">{{ $invoice->paid }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom td-head">
                                                <b> المتبقي - remaining </b>
                                            </td>
                                            <td class="border-bottom">{{ $invoice->rest }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

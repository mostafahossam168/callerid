@extends('doctor.layouts.index')
@push('css')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    section {
        text-align: center;
        padding: 0 50px;
    }


    .main-head {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        margin-top: 30px;
        gap: 20px;
    }

    .main-head h1 {
        font-size: 27px;
        font-weight: normal;
    }

    .main-head h1.ar {
        font-size: 39px;
    }

    .main-head h1 span {
        font-weight: bold;
    }

    .main-head img {
        width: 64px;
    }

    table {
        margin: auto;
        width: 100%;
        font-size: 14px;
    }

    @media(min-width: 200px) and (max-width: 576px) {
        table {
            font-size: 6px !important;
        }
    }

    @media(min-width: 576px) and (max-width: 768px) {
        table {
            font-size: 8px !important;
        }
    }

    @media(min-width: 768px) and (max-width: 992px) {
        table {
            font-size: 10px !important;
        }
    }

    @media(min-width: 992px) and (max-width: 1200px) {
        table {
            font-size: 11px !important;
        }
    }

    @media(min-width: 1200px) and (max-width: 1400px) {
        table {
            font-size: 12px !important;
        }
    }

    table tr td,
    table tr th {
        padding: 5px 5px;
        position: relative;
    }

    table tr td .rig {
        float: right;
    }

    table tr td .lef {
        float: left;
        margin-right: 5px;
    }

    table tr td .cen {
        position: absolute;
        /* left: 50%; */
        left: 40%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    table tr td.hidd-1 {
        border-left-color: transparent;
    }

    table tr td.hidd-2 {
        border-left-color: transparent;
    }

    .text {
        display: flex;
        justify-content: space-evenly;
        margin-top: 10px;
    }

    .print {
        text-decoration: none;
        color: white;
        background-color: #2fc2df;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        margin: 20px auto 0;
        display: block;
        width: fit-content;
    }

    @media print {
        .main-section {
            background-color: #fff;
        }

        section {
            padding: 0px !important;
            height: 100vh;
        }


        table {
            width: 100%;
            font-size: 11px !important;
        }

        table tr td div {
            display: flex;
            float: unset;
            justify-content: space-between;
        }

        section {
            padding: 0;
        }

        body {
            font-size: 5px;
        }

        table tr td .pir-r {
            margin-left: 25px;
        }

        table tr td .pir-l {
            margin-right: 25px;
        }

        .print {
            display: none;
        }

        table,
        th,
        td {
            padding: 3px !important;
            border: 1px solid black;
            border-collapse: collapse;
        }

        table tr td .cen {
            left: 32% !important;
        }

        table tr td .cen.one {
            left: 40% !important;
        }
    }
</style>
@endpush
@section('title')
{{ __('admin.Show invoice') }}
@endsection
@section('content')
<div class="ayada">
    <div class="pic-con">
        <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
        <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
    </div>
    <div class="pic-con2">
        <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
        <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
    </div>
    <div class="pic-con3">
        <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
        <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
    </div>
    <div class="pic-con4">
        <img src="{{ asset('img/pic.png') }}" class="pic1" alt="">
        <img src="{{ asset('img/pic.png') }}" class="pi2" alt="">
    </div>
    @if (setting()->active_water_mark)
    <p class="text-mark">{{ setting()->water_mark_string }}</p>
    @endif
    <section>
        <div class="page">
            <div class="content">
                <div class="text align-items-center justify-content-between  mt-1 mb-2 ">
                    <div class="text-end ">
                        <p class="me-1 fw-bold">{{ setting()->site_name }}</p>
                        <div class="me-1">{{ __('admin.address') }}: {{ setting()->address }}</div>
                        <div class="me-1">الجوال: {{ setting()->phone }}</div>
                        <div>
                            <span class="me-1">{{ __('admin.build_num') }}: {{ setting()->build_num }}</span>
                            <span class="me-1">{{ __('admin.unit_num') }}: {{ setting()->unit_num }}</span>
                        </div>
                        <div class="me-1">{{ __('admin.Postal code') }}: {{ setting()->postal_code }}</div>
                        <span class="me-1">{{ __('admin.extra figure') }}: {{ setting()->extra_number }}</span>
                    </div>
                    <!-- <p>{{ setting()->site_name }}</p> -->
                    <div>
                        <img src="{{ display_file(setting()->logo) }}" width="100px" alt="">
                        <h4 class="mb-0 title-style-font">{{ __('admin.Simplified tax invoice') }}</h4>
                    </div>
                    <div class="">
                        <div class="me-1">اسم المالك: {{ $invoice->patient?->name }}</div>
                        @if ($invoice->patient->tax_number)
                        <div class="me-1">الرقم الضريبي: {{ $invoice->patient?->tax_number }}</div>
                        @endif
                        @if ($invoice->patient->address)
                        <div class="me-1">العنوان: {{ $invoice->patient?->address }}</div>
                        @endif
                        @if ($invoice->patient->email)
                        <div class="me-1">البريد: {{ $invoice->patient?->email }}</div>
                        @endif
                        @if ($invoice->patient->phone)
                        <div class="me-1">الجوال: {{ $invoice->patient?->phone }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <table class="mb-3 ">
                <tr class="bg-gray">
                    <td colspan="4">
                        <div>
                            <span class="rig"><strong>رقم الفاتورة</strong>:
                                {{ $invoice->id }}</span>
                            <span dir="ltr" class="lef"><strong>id/invoice</strong>:-</span>
                        </div>
                    </td>
                    <td colspan="4">
                        <span class="rig"><strong>التاريخ</strong></span>
                        <span class="cen">{{ $invoice->created_at->format('Y-m-d') }}</span>
                        <span dir="ltr" class="lef"><strong>Date</strong></span>
                    </td>
                    <td colspan="4">
                        <span class="rig"><strong>رقم الملف</strong></span>
                        <span class="cen">{{ $invoice->patient?->id }}</span>
                        <span dir="ltr" class="lef"><strong>File.No</strong></span>
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td colspan="3" rowspan='2'>
                        {{-- @dd($invoice->animals) --}}
                        @forelse ($invoice->animals as $animal)
                        <div>
                            <span class="rig"><strong>أسم الأليف</strong>:
                                {{ $animal->name }}</span>
                            <span dir="ltr" class="lef"><strong>Animal Name</strong>:-</span>
                        </div>
                        <br>
                        <div>
                            <span class="rig"><strong>العمر</strong>:
                                {{ $animal->age }}</span>
                            <span dir="ltr" class="lef"><strong> Age</strong>:-</span>
                        </div>
                        <br>
                        <div>
                            <span class="rig"><strong>السلالة</strong>:
                                {{ $animal->strain?->name }} </span>
                            <span dir="ltr" class="lef"><strong> Breed</strong>:-</span>
                        </div>
                        <br>
                        <hr>
                        @empty
                        لا يوجد حيوانات في هذة الفاتورة
                        @endforelse
                    </td>
                    <!-- <td colspan="2">-</td> -->
                </tr>
                <tr>
                    <td colspan="4">
                        <span class="rig"><strong>أسم الطبيب</strong></span>
                        <span>{{ $invoice->dr?->name }}</span>
                        <span dir="ltr" class="lef"><strong>Vet.Name</strong></span>
                    </td>
                    <td colspan="4">
                        <span class="rig"><strong>{{ __('Clinic') }}</strong></span>
                        <span>{{ $invoice->department?->name }}</span>
                        <span dir="ltr" class="lef"><strong>Clinic</strong></span>
                    </td>
                </tr>
                <tr class="bg-gray">
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>اسم الخدمة</span>
                            <span>Service Name</span>
                        </div>
                    </th>
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>السعر</span>
                            <span>price</span>
                        </div>
                    </th>
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>العدد</span>
                            <span>Number</span>
                        </div>
                    </th>
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>#الخصم</span>
                            <span>#Discount</span>
                        </div>
                    </th>

                    @if (setting()->tax_enabled)
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>%{{ __('admin.tax') }}</span>
                            <span>%VAT</span>
                        </div>
                    </th>
                    @endif
                    <th colspan="2">
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <span>الإجمالي</span>
                            <span>Total</span>
                        </div>
                    </th>
                </tr>
                @foreach ($invoice->products as $item)
                <tr>
                    <td colspan="2" dir="ltr">
                        {{ $item->product_name }}
                    </td>
                    <td colspan="2">{{ $item->price }}</td>
                    <td colspan="2">{{ $item->quantity }}</td>
                    <td colspan="2">{{ $item->discount }}</td>
                    <td colspan="2">{{ $item->tax }}</td>
                    {{-- <td colspan="2">{{ ($item->price  * $item->quantity) + $item->tax }}</td> --}}
                    <td colspan="2">{{ $item->sub_total }}</td>
                </tr>
                @endforeach

                <tr height="60px" class="height">
                    <td class="hidd-1" colspan="2"></td>
                    <td class="hidd-2" colspan="3"></td>
                    <td colspan="12"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        @if (setting()->tax_enabled)
                        <span class="rig pir-r"><strong>المبلغ قبل الضريبة</strong></span>
                        @else
                        <span class="rig pir-r"><strong>المبلغ</strong></span>
                        @endif
                        <span class="cen">{{ $invoice->amount }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>ِAmount</strong></span>
                    </td>
                    <td colspan="4">
                        <span class="rig"><strong>حالة الفاتورة</strong></span>
                        <span dir="ltr">مسدد</span>
                        <span dir="ltr" class="lef"><strong>in.status</strong></span>
                    </td>
                    <td rowspan="2" colspan="4">
                        <span class="rig"><strong>ملاحظة</strong></span>
                        <span dir="ltr" class="lef"><strong>{{ $invoice->notes }}</strong></span>
                    </td>
                    <td rowspan="5">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="rig pir-r"><strong>أجمالي الخصم</strong></span>
                        <span class="cen">{{ $invoice->discount + $invoice->offers_discount }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Discount</strong></span>
                    </td>
                    <td rowspan="2">
                        <strong>المدفوع-Paid</strong><br />{{ $invoice->cash + $invoice->card }}
                    </td>
                    <td rowspan="2" colspan="2">
                        <strong>نقدي-Cash</strong><br />{{ $invoice->cash }}
                    </td>
                    <td rowspan="2"><strong>شبكه-Atm</strong><br />{{ $invoice->card }}</td>
                </tr>
                <tr>
                    <td colspan="2">
                    </td>
                    <td colspan="4" rowspan='2'>
                        <span class="rig"><strong>التوقيع</strong></span>
                        <span dir="ltr" class="lef"><strong>Sign:</strong></span>
                    </td>
                </tr>
                <tr>
                    @if (setting()->tax_enabled)
                    <td colspan="2">
                        <span class="rig pir-r"><strong>قيمة الضريبة المضافة</strong></span>
                        <span class="cen pir-l">{{ $invoice->tax }}</span>
                        <span dir="ltr" class="lef"><strong>VAT</strong></span>
                    </td>
                    @endif

                    <td rowspan="2" colspan="4">
                        <strong>المتبقي-Remain</strong><br />{{ $invoice->rest }}
                    </td>

                </tr>
                <tr>
                    <td colspan="2">
                        @if (setting()->tax_enabled)
                        <span class="rig pir-r"><strong>المبلغ شامل الضريبة</strong></span>
                        @else
                        <span class="rig pir-r"><strong>المبلغ</strong></span>
                        @endif
                        <span class="cen">{{ $invoice->total }}</span>
                        <span dir="ltr pir-l" class="lef"><strong>Total</strong></span>
                    </td>
                    <td colspan="4">
                        <div>
                            <span class="rig"><strong>الموظف:</strong>
                                {{ $invoice->employee?->name }}</span>
                            <span dir="ltr" class="lef"><strong>Employee:</strong></span>
                        </div>
                    </td>
                </tr>
                <!-- <tr>
                    <td colspan="12" class="">
                        <span class="me-1">{{ __('admin.address') }}: {{ setting()->address }}</span>
                        <span class="me-1">{{ __('admin.build_num') }}: {{ setting()->build_num }}</span>
                        <span class="me-1">{{ __('admin.unit_num') }}: {{ setting()->unit_num }}</span>
                        <span class="me-1">{{ __('admin.Postal code') }}: {{ setting()->postal_code }}</span>
                        <span class="me-1">{{ __('admin.extra figure') }}: {{ setting()->extra_number }}</span>
                    </td>
                </tr> -->
            </table>
            <div dir="ltr" class="text">
                <span>شكرا لزيارتكم</span>
            </div>
        </div>
    </section>

</div>
@endsection

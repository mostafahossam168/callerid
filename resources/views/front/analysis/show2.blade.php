@extends('front.layouts.front')
@section('title', 'نتائج التحليل')
@section('content')
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
        margin-bottom: 20px;
        margin-top: 30px;
        gap: 20px;
    }

    .main-head h1.ar {
        font-size: 33px;
        font-weight: normal;
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
        border: 1px solid black !important;
    }

    .qr-table-holder>svg {
        width: 100px;
        height: 100px;
    }

    @media (min-width: 200px) and (max-width: 576px) {

        table tr td,
        table tr th {
            padding: 4px 3px !important;
        }

        table {
            font-size: 6px !important;
        }

        .qr-table-holder>svg {
            width: 50px;
            height: 50px;
        }

        section {
            padding: 0px 5px;
        }

        .main-head {
            margin-bottom: 10px;
        }

        .main-head h1.ar {
            font-size: 21px;
        }

        .height {
            height: 30px !important;
        }
    }

    @media (min-width: 576px) and (max-width: 768px) {
        table {
            font-size: 8px !important;
        }

        .main-head {
            margin-bottom: 10px;
        }

        .qr-table-holder>svg {
            width: 75px;
            height: 75px;
        }
    }

    @media (min-width: 768px) and (max-width: 992px) {
        table {
            font-size: 10px !important;
        }
    }

    @media (min-width: 992px) and (max-width: 1200px) {
        table {
            font-size: 11px !important;
        }
    }

    @media (min-width: 1200px) and (max-width: 1400px) {
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
        border: 1px solid black !important;
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
            /* background-color: #fff; */
            /* height: 100vh; */
        }


        table {
            width: 100%;
            font-size: 9px !important;
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
            border: 1px solid black !important;
            border-collapse: collapse;
        }

        table tr td .cen {
            left: 32% !important;
        }

        table tr td .cen.one {
            left: 40% !important;
        }

        .qr-table-holder {
            width: 100%;
            text-align: center;
            margin-right: 15px !important;
        }

        .qr-table-holder>svg {
            width: 85px;
            height: 85px;
        }
    }
</style>
<section class="main-section medical-result-section home">
    <div class="container">
        <button class="btn btn-sm btn-danger mb-3" id="pdf-btn">تصدير pdf</button>
        <button class="btn btn-sm btn-warning mb-3" id="btn-prt-content">طباعه</button>
        <div class="bg-white box-analysis" id="prt-content">
            <div class="box-invoice bg-white">
                <div class="row">
                    <div class="col-md-4 p-3">
                        <p>
                            <b> {{ setting()->site_name }}</b>
                        </p>
                        <p><b>@lang('admin.Tax number'): </b> {{ setting()->tax_number }}</p>
                        <p>
                            <b> @lang('admin.Email'): </b> {{ setting()->email }}
                        </p>
                    </div>
                    <div class="text-center col-md-4 p-3">
                        <img class="" src="{{ display_file(setting()->logo) }}" alt=""
                            width="200">
                        <h6 class="text-center "><b>{{ $analysis->package?->name }}</b></h6>
                    </div>
                    <div class="col-md-4 p-3">
                        <p>
                            <b>@lang('admin.Owner name'):</b> {{ $analysis->owner?->name }}
                        </p>
                        <p><b>@lang('admin.Animal'):</b> {{ $analysis->animal->name }}</p>
                        <p><b>@lang('admin.Date'):</b> {{ $analysis->hijri_date }}</p>
                    </div>
                </div>
            </div>
            <!-- <img src="{{asset('front-assets/img/header-prt.png')}}" class="header-prt" alt="header">
                <img src="{{asset('front-assets/img/mark-prt.png')}}" class="mark-prt" alt="header"> -->
            <div class="medical-result-holder">
                <div class="medical-result w-sm0">
                    @php
                    $department_ids = $analysis->items()->orderBy('department_id')->pluck('department_id')->toArray();
                    $departments = \App\Models\Mkhtbr\AnalysisDepartment::whereIn('id', $department_ids)->get();
                    $parent_ids = $departments->pluck('parent')->toArray();
                    $parent_departments = \App\Models\Mkhtbr\AnalysisDepartment::whereIn('id', $parent_ids)->orderBy('sort','desc')->get();
                    @endphp
                    <div class="d-flex flex-column flex-wrap">
                        <div class="d-flex flex-wrap w-100 ">
                            <div class="w-100 d-flex align-items-center border-bt">
                                <div class="flex-fill d-flex justify-content-between text-center align-items-center pd">
                                    <b class="w-lg">اسم العميل : </b>
                                    <b class="w-sm">{{ $analysis->owner?->name }}</b>
                                    <b dir="ltr" class="w-sm">رقم الجوال :</b>
                                    <b class="w-lg">{{ $analysis->owner?->phone }}</b>
                                    <b dir="ltr" class="w-sm">lab id : </b>
                                    <b class="w-lg">{{ $analysis->lab_id }}</b>
                                </div>
                            </div>
                        </div>
                        @foreach ($parent_departments as $index => $department)
                        @php
                        $isMultiChild = $department->children->count() > 1;
                        @endphp
                        <div class=" w-100 ">
                            <div class="border-bt fw-bold text-center pd result-title {{ $index % 2 == 0 ? 'blue' : 'purple' }} ">
                                {{ $department->name_en }} - {{ $department->name_ar }}
                            </div>
                            <div class="border-bt fw-bold pd {{ $index % 2 == 0 ? 'blue' : 'purple' }} d-flex align-items-center">
                                <span class="title text-center pd">N.Range</span>
                                <div class="d-flex align-items-center flex-fill text-center">
                                    <b class="w-lg"> </b>
                                    <span class="w-sm">Unit</span>
                                    <span class="w-sm">Result</span>
                                    <b class="w-lg"> </b>
                                </div>
                                @if ($isMultiChild)
                                <span class="title text-center pd">N.Range</span>
                                <div class="d-flex align-items-center flex-fill text-center">
                                    <b class="w-lg"> </b>
                                    <span class="w-sm">Unit</span>
                                    <span class="w-sm">Result</span>
                                    <b class="w-lg"> </b>
                                </div>
                                @endif
                            </div>
                            <div class="d-flex flex-wrap w-100 ">
                                @foreach ($department->children()->whereIn('id', $department_ids)->get() as $child)
                                @php
                                $result = $analysis
                                ->items()
                                ->where('department_id', $child->id)
                                ->first()?->result;
                                $range = $analysis->package
                                ->package_departments()
                                ->where('analysis_department_id', $child->id)
                                ->first()?->range;


                                @endphp
                                <div class="{{ $isMultiChild ? 'w-50 border-lf' : 'w-100' }} d-flex align-items-center border-bt">
                                    <div class="title border-lf dark text-center pd" dir="ltr">
                                        {{ $range }}
                                    </div>
                                    <div class="flex-fill d-flex justify-content-between text-center align-items-center pd">
                                        <b class="w-lg">{{ $child->name_ar }}</b>
                                        <span class="w-sm">{{ $child->unit }}</span>
                                        <span dir="ltr" class="w-sm {{ getClassForResult($child, $result, $analysis) }}">{{ $result }}</span>
                                        <b class="w-lg">{{ $child->name_en }}</b>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="fw-bold pd dark text-center">
                        <span class="fw-bold">Recmondations: </span>
                        <p class="mb-0" style="white-space: pre-line"> {{ $analysis->recmondations  }} </p>
                    </div>
                </div>
            </div>
            <!-- <img src="{{asset('front-assets/img/footer-prt.png')}}" class="footer-prt" alt="header"> -->
        </div>
    </div>
</section>
@push('js')
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.getElementById("pdf-btn").addEventListener("click", function() {
        var element = document.getElementById('prt-content');
        html2canvas(element, {
            backgroundColor: null
        }).then(function(canvas) {
            var imgData = canvas.toDataURL('image/jpeg', 1.0);
            var pdf = new jspdf.jsPDF('p', 'mm', 'a4');
            var imgWidth = 206;
            var pageHeight = 289;
            var imgHeight = 280;
            // var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;

            var margin = 2;
            var position = margin;

            pdf.addImage(imgData, 'JPEG', margin, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight + margin;
                pdf.addPage();
                pdf.addImage(imgData, 'JPEG', margin, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save("{{ 'نتيجة تحليل ' . $analysis->animal->name }}");
        });
    });
</script>
@endpush
@endsection

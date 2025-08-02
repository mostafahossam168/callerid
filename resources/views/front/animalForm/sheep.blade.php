@extends('front.layouts.front')
@section('title')
{{ __('admin.Transferred patients') }}
@endsection
@section('content')

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
@endpush
<div class="ayada">
    <div class="pic-con">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
    </div>
    <div class="pic-con2">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
    </div>
    <div class="pic-con3">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
    </div>
    <div class="pic-con4">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
    </div>
    <section>

        <div class="page container ">
            <!-- <header>
                <img src="{{asset('img/logo.png')}}" alt="">
            </header> -->
            <div class="row justify-content-center ">
                <div class="col-12 col-md-9">
                    <div class="content">
                        <div class="text align-items-center">
                            <p>{{ setting()->site_name }}</p>
                            <h4 class="mb-0">نموذج 2</h4>
                        </div>
                    </div>
                    <table class="table  ">
                        <thead>
                            <tr>
                                <td colspan="4"><b>وظائف الكلي</b></td>
                                <td colspan="4">
                                    <b>
                                        صورة الدم الكاملة CBC
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td><b>النسبة الطبيعية</b></td>
                                <td><b>وحدة القياس</b></td>
                                <td><b>العدد</b></td>
                                <td></td>
                                <td><b>النسبة الطبيعية</b></td>
                                <td><b>وحدة القياس</b></td>
                                <td><b>العدد</b></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0 " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>Creatinine</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>WBCs</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>Urea</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>LYM%</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>وظائف الكبد</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>MON%</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>AST</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>NEUT%</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>ALT</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>EOS%</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>GGT%</b>
                                </td>
                                <td colspan="4">
                                    <b>
                                        كريات الدم الحمراء RBCs
                                    </b>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>Albumin</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>RBCs</b>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>Protien</b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>HGB</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>
                                        الجلوكوز Glucose
                                    </b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>

                                <td>
                                    <b>HCT</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>
                                        Glucose
                                    </b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>MCV</b>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <b>
                                        العضلات Muscle Profile
                                    </b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>MCH</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>انزيم القلب</b>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control py-0  " id="">
                                    </div>
                                </td>
                                <td>
                                    <b>MCHC</b>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="4">
                                    <b>
                                        الاملاج المعدنية Minerals
                                    </b>
                                </td>
                                <td colspan="4">
                                    <b>
                                        الصفائح الدموية Platelets
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <b>
                                        Ca
                                    </b>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <b>
                                        Plt
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <b>
                                        Iron
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around ">
                                        <input type="text" name="" class="form-control  py-0" id="">
                                    </div>
                                </td>
                                <td>
                                    <b> Phos
                                    </b>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="content mb-4">
                        <div class="text align-items-center">
                            <h4 class="mb-0">الطفيليات الدم</h4>
                        </div>
                    </div>
                    <table class=" mb-3">
                        <tr>
                            <td><b>الاختبار</b></td>
                            <td><b>Trypanosoma</b></td>
                            <td><b>Anapisma</b></td>
                            <td><b>Babesia</b></td>
                            <td><b>Thieleria</b></td>
                        </tr>
                        <tr>
                            <td><b>النتائج</b></td>
                            <td>
                                <input type="text" name="" class="form-control w" id="">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control" id="">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control" id="">
                            </td>
                            <td>
                                <input type="text" name="" class="form-control" id="">
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <button class="btn-success btn btn-sm px-5 my-3">حفظ</button>
    </section>
</div>

@endsection

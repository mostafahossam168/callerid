<!-- <div class="py-5">
    <div class="container">
        <div class="row g-4">
            @foreach ($params as $parameter)
                <div class="col-sm-2 col-md-3 col-lg-4">
                    <label for="{{ $parameter }}">{{ ucfirst($parameter) }}</label>
                    <input type="text" class="form-control" id="{{ $parameter }}" wire:model="animal_test.{{ $parameter }}">
                </div>
                <div class="col-sm-2 col-md-3 col-lg-4">
                    <label for="{{ $parameter }}_unit">{{ ucfirst($parameter) }} Unit</label>
                    <input type="text" class="form-control" id="{{ $parameter }}_unit" wire:model="animal_test.{{ $parameter }}_unit">
                </div>
                <div class="col-sm-2 col-md-3 col-lg-4">
                    <label for="{{ $parameter }}_reference_range">{{ ucfirst($parameter) }} Reference Range</label>
                    <input type="text" class="form-control" id="{{ $parameter }}_reference_range"
                           wire:model="animal_test.{{ $parameter }}_reference_range">
                </div>
            @endforeach
            <div class="col-12">
                <hr>
            </div>
            @foreach ($additional as $param)
            <div class="col-sm-2 col-md-3 col-lg-4">
            <label for="{{ $param }}">{{ ucfirst($param) }}</label>
            <input type="text" class="form-control" id="{{ $param }}" wire:model="animal_test.{{ $param }}">
            </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
        <button wire:click="submit" class="btn btn-primary">ارسال</button>
        </div>
    </div>

</div> -->

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

        <div class="page">
            <!-- <header>
                <img src="{{asset('img/logo.png')}}" alt="">
            </header> -->
            <div class="content">
                <div class="text align-items-center">
                    <p>{{ setting()->site_name }}</p>
                    <h4 class="mb-0">نموذج 1</h4>
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
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>Creatinine</b>
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
                        <td>
                            <b>WBCs</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>Urea</b>
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
                        <td>
                            <b>LYM%</b>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>وظائف الكبد</b>
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
                        <td>
                            <b>MON%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>AST</b>
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
                        <td>
                            <b>NEUT%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>ALT</b>
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
                        <td>
                            <b>EOS%</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
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
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>Albumin</b>
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
                        <td>
                            <b>RBCs</b>
                        </td>

                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>Protien</b>
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
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>

                        <td>
                            <b>HCT</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>
                                Glucose الجلكوز
                            </b>
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
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>MCH</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>انزيم القلب</b>
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
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>
                                Ca/ كالسيوم
                            </b>
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
                        <td>
                            <b>
                                Plt عدد الصفائح الدموية
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b>
                                Iron/ الحديد
                            </b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <input type="text" name="" class="form-control" id="">
                        </td>
                        <td>
                            <b> Phos/ فسفور
                            </b>
                        </td>
                    </tr>
                </thead>
            </table>
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
                        <input type="text" name="" class="form-control" id="">
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
            <div class="content mb-4">
                <div class="text align-items-center">
                    <h4 class="mb-0">الطفيليات المعوية</h4>
                </div>
            </div>
            <table class=" mb-5">
                <tr>
                    <td><b>الاختبار</b></td>
                    <td><b>Nematodes</b></td>
                    <td><b>Cestodes</b></td>
                    <td><b>Pin worms</b></td>
                    <td><b>Balantidium coli trophozoites</b></td>
                    <td colspan="2"><b>Others</b></td>
                </tr>
                <tr>
                    <td><b>النتائج</b></td>
                    <td>
                        <input type="text" name="" class="form-control" id="">
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
                    <td>
                        <input type="text" name="" class="form-control" id="">
                    </td>
                </tr>
            </table>
        </div>
        <button class="btn-success btn btn-sm px-5 my-3">حفظ</button>
    </section>
</div>

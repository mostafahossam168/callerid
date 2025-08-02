@extends('front.layouts.front')

@section('title')
    {{ __('admin.Show invoice') }}
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

            .qr-table-holder > svg {
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

                .qr-table-holder > svg {
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

                .qr-table-holder > svg {
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

                .qr-table-holder > svg {
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
                <table class="table ">
                    <thead>
                    <tr>
                        <th>رقم الشريحة</th>
                        <th>اسم العميل</th>
                        <th>نوع الحيوان</th>
                        <th>جنس الحيوان</th>
                        <th>تاريخ التحليل</th>
                    </tr>
                    <tbody>
                    <tr>
                        <td>{{$file->id}}</td>
                        <td>{{$file->patient?->name}}</td>
                        <td>{{$file->animal?->type}}</td>
                        <td>{{$file->animal?->gender}}</td>
                        <td>{{$file->created_at->format('Y-m-d')}}</td>
                    </tr>
                    </tbody>
                    </thead>
                </table>
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
                        <td>
                            {{$file->animal_test['creatinine_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['creatinine_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['creatinine'] ?? ''}}
                        </td>
                        <td>
                            Creatinine
                        </td>
                        <td>
                            {{$file->animal_test['wbcs_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['wbcs_unit'] ?? ''}}

                        </td>
                        <td>
                            {{$file->animal_test['wbcs'] ?? ''}}
                        </td>
                        <td>
                            WBCs
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['urea_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['urea_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['urea'] ?? ''}}
                        </td>
                        <td>
                            Urea
                        </td>
                        <td>
                            {{$file->animal_test['lym_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['lym_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['lym'] ?? ''}}
                        </td>
                        <td>
                            LYM%
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>وظائف الكبد</b>
                        </td>
                        <td>
                            {{$file->animal_test['mon_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mon_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mon'] ?? ''}}
                        </td>
                        <td>
                            MON%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['ast_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ast_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ast'] ?? ''}}
                        </td>
                        <td>
                            AST
                        </td>
                        <td>
                            {{$file->animal_test['neut_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['neut_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['neut'] ?? ''}}
                        </td>
                        <td>
                            NEUT%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['alt_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['alt_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['alt'] ?? ''}}
                        </td>
                        <td>
                            ALT
                        </td>
                        <td>
                            {{$file->animal_test['eos_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['eos_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['eos'] ?? ''}}
                        </td>
                        <td>
                            EOS%
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['ggt_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ggt_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ggt'] ?? ''}}
                        </td>
                        <td>
                            GGT%
                        </td>
                        <td colspan="4">
                            <b>
                                كريات الدم الحمراء RBCs
                            </b>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            {{$file->animal_test['albumin_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['albumin_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['albumin'] ?? ''}}
                        </td>
                        <td>
                            Albumin
                        </td>
                        <td>
                            {{$file->animal_test['rbcs_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['rbcs_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['rbcs'] ?? ''}}
                        </td>
                        <td>
                            RBCs
                        </td>

                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['protein_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['protein_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['protein'] ?? ''}}
                        </td>
                        <td>
                            Protien
                        </td>
                        <td>
                            {{$file->animal_test['hgb_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['hgb_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['hgb'] ?? ''}}
                        </td>
                        <td>
                            HGB
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>
                                الجلوكوز Glucose
                            </b>
                        </td>
                        <td>
                            {{$file->animal_test['hct_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['hct_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['hct'] ?? ''}}
                        </td>

                        <td>
                            HCT
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['gulcose_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['gulcose_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['gulcose'] ?? ''}}
                        </td>
                        <td>
                            Glucose الجلكوز
                        </td>
                        <td>
                            {{$file->animal_test['mcv_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mcv_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mcv'] ?? ''}}
                        </td>
                        <td>
                            MCV
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <b>
                                العضلات Muscle Profile
                            </b>
                        </td>
                        <td>
                            {{$file->animal_test['mch_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mch_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mch'] ?? ''}}
                        </td>
                        <td>
                            MCH
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['ck_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ck_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['ck'] ?? ''}}
                        </td>
                        <td>
                            انزيم القلب
                        </td>

                        <td>
                            {{$file->animal_test['mchc_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mchc_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['mchc'] ?? ''}}
                        </td>
                        <td>
                            MCHC
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
                            {{$file->animal_test['calcium_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['calcium_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['calcium'] ?? ''}}
                        </td>
                        <td>
                            Ca/ كالسيوم
                        </td>

                        <td>
                            {{$file->animal_test['plt_count_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['plt_count_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['plt_count'] ?? ''}}
                        </td>

                        <td>
                            Plt عدد الصفائح الدموية
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['iron_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['iron_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['iron'] ?? ''}}
                        </td>
                        <td>
                            Iron/ الحديد
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{$file->animal_test['phos_reference_range'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['phos_unit'] ?? ''}}
                        </td>
                        <td>
                            {{$file->animal_test['phos'] ?? ''}}
                        </td>
                        <td>
                            Phos/ فسفور
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
                        <td><b>النتائج</b></td>
                        <td><b>الاختبار</b></td>
                    </tr>
                    <tr>
                        <td>{{$file->animal_test['trypanosoma_blood'] ?? ''}}</td>
                        <td>Trypanosoma</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['anapisma_blood'] ?? ''}}</td>
                        <td>Anapisma</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['babesia_blood'] ?? ''}}</td>
                        <td>Babesia</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['thieleria_blood'] ?? ''}}</td>
                        <td>Thieleria</td>
                    </tr>
                </table>
                <div class="content mb-4">
                    <div class="text align-items-center">
                        <h4 class="mb-0">الطفيليات المعوية</h4>
                    </div>
                </div>
                <table class=" mb-5">
                    <tr>
                        <td><b>النتائج</b></td>
                        <td><b>الاختبار</b></td>
                    </tr>
                    <tr>
                        <td> {{$file->animal_test['nematodes_intestinal'] ?? ''}}</td>
                        <td>Nematodes</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['cestodes_intestinal'] ?? ''}}</td>
                        <td>Cestodes</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['pin_worms_intestinal'] ?? ''}}</td>
                        <td>Pin worms</td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['balantidium_coli_trophozoites_intestinal'] ?? ''}}</td>
                        <td>Balantidium coli trophozoites </td>
                    </tr>
                    <tr>
                        <td>  {{$file->animal_test['others_intestinal'] ?? ''}}</td>
                        <td>Others </td>
                    </tr>
                </table>
            </div>
        </section>
    </div>
@endsection

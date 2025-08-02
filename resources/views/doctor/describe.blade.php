@extends('doctor.layouts.index')
@section('title')
وصفات طبية
@endsection
@section('content')
<section class="main-section users">
    <div class="container" id="data-table">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">الوصفات الطبية</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-xl-row">
                <div class="row my-3 g-2">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-10 d-flex flex-column flex-lg-row gap-2 px-0">


                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                بحث
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:change="resetPage" wire:model="patient_id" placeholder="  بحث برقم الوصفة ">
                        </div>
                        <div dir="ltr" class="input-group mb-2 mb-md-0">
                            <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                                بحث
                            </button>
                            <input dir="rtl" type="text" class="form-control" wire:model="patient_name" placeholder="  بحث برقم جوال أو أسم المريض ">
                        </div>
                    </div>
                </div>
                <div class="btn-holders d-flex align-items-center gap-1 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip fs-10px" data-bs-title="توفير معلومات عن الأمراض والحالات الطبية، وإرشاد المرضى حول العلاجات المتاحة، والوقاية من الأمراض" data-bs-original-title="" title="">
                        <i class="fa-solid fa-question"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <a class="btn btn-sm btn-outline-primary rounded-0" href="">
                        تصدير Excel
                        <i class="fa-solid fa-file-import"></i>
                    </a>
                </div>
            </div>

            <div class="">

                <div id="prt-content" class="table-print">
                    <x-header-invoice />
                    <div class="table-responsive">

                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>رقم الوصفة</th>
                                    <th>المريض</th>
                                    <th>الطبيب</th>
                                    <th>الصيدلي</th>
                                    <th>التاريخ</th>
                                    <th>الادوية</th>
                                    <th>الجرعات</th>
                                    <th>الصرف</th>
                                    <th class="text-center not-print">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>
                                        <span class="badge bg-success fs-14">مقبول</span>
                                    </td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('doctor.describe-show') }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="fit-tooltip" data-bs-title="حذف" data-bs-toggle="modal" data-bs-target="#delete_agent" class="btn btn-sm btn-purple">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>--</td>
                                    <td>
                                        <span class="badge bg-warning fs-14">انتظار</span>
                                    </td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                        <a href="{{ route('doctor.describe-show') }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="fit-tooltip" data-bs-title="حذف" data-bs-toggle="modal" data-bs-target="#delete_agent" class="btn btn-sm btn-purple">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="delete_agent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">



                                <div class="modal-body">
                                    هل أنت متأكد من عملية الحذف؟
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">تراجع</button>
                                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click="delete({&quot;id&quot;:43,&quot;civil&quot;:null,&quot;first_name&quot;:&quot;\u062c\u0648\u0627\u062f \u0627\u0644\u0627\u062d\u0645\u062f &quot;,&quot;parent_name&quot;:null,&quot;grand_name&quot;:null,&quot;last_name&quot;:null,&quot;user_id&quot;:1,&quot;relationship_id&quot;:null,&quot;gender&quot;:&quot;male&quot;,&quot;city_id&quot;:1,&quot;country_id&quot;:null,&quot;birthdate&quot;:null,&quot;age&quot;:null,&quot;phone&quot;:&quot;0501906681&quot;,&quot;phone2&quot;:null,&quot;near_name&quot;:null,&quot;near_mobile&quot;:null,&quot;notes_health_record&quot;:null,&quot;goal_of_visit&quot;:null,&quot;penicillin&quot;:0,&quot;teeth_problems&quot;:0,&quot;drugs&quot;:0,&quot;heart&quot;:0,&quot;pressure&quot;:0,&quot;fever&quot;:0,&quot;anemia&quot;:0,&quot;thyroid_glands&quot;:0,&quot;liver&quot;:0,&quot;sugar&quot;:0,&quot;tb&quot;:0,&quot;kidneys&quot;:0,&quot;convulsion&quot;:0,&quot;other_diseases&quot;:null,&quot;image&quot;:null,&quot;date&quot;:null,&quot;created_at&quot;:&quot;2024-05-07T04:26:34.000000Z&quot;,&quot;updated_at&quot;:&quot;2024-05-07T04:26:34.000000Z&quot;,&quot;insurance_id&quot;:null,&quot;visitor&quot;:null,&quot;is_pregnant&quot;:0,&quot;fluidity&quot;:null,&quot;aids&quot;:null,&quot;strokes&quot;:null,&quot;tuberculosis&quot;:null,&quot;epilepsy&quot;:null,&quot;psychiatric&quot;:null,&quot;cancer&quot;:null,&quot;eating_meat&quot;:null,&quot;fruits_and_vegetables&quot;:null,&quot;smoking&quot;:null,&quot;other_habits&quot;:null,&quot;family_fluidity&quot;:null,&quot;family_pressure&quot;:null,&quot;family_heart&quot;:null,&quot;family_sugar&quot;:null,&quot;family_liver&quot;:null,&quot;family_aids&quot;:null,&quot;family_strokes&quot;:null,&quot;family_epilepsy&quot;:null,&quot;family_kidneys&quot;:null,&quot;family_psychiatric&quot;:null,&quot;family_anemia&quot;:null,&quot;family_cancer&quot;:null,&quot;family_smoking&quot;:null,&quot;allergies&quot;:null,&quot;family_allergies&quot;:null,&quot;pharmaceutical&quot;:null,&quot;family_pharmaceutical&quot;:null,&quot;past_surgical&quot;:null,&quot;family_past_surgical&quot;:null,&quot;safety_of_senses&quot;:null,&quot;family_safety_of_senses&quot;:null,&quot;last_visit_question&quot;:null,&quot;last_visit_answer&quot;:null,&quot;receive_offers&quot;:null,&quot;points&quot;:0,&quot;department_id&quot;:null,&quot;tax_number&quot;:null,&quot;address&quot;:null,&quot;street&quot;:null,&quot;building_number&quot;:null,&quot;postal_code&quot;:null,&quot;email&quot;:null,&quot;animals_count&quot;:1,&quot;last_visit&quot;:&quot;2024-05-25&quot;,&quot;country&quot;:null,&quot;user&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;admin&quot;,&quot;email&quot;:&quot;admin@admin.com&quot;,&quot;type&quot;:&quot;admin&quot;,&quot;department_id&quot;:null,&quot;salary&quot;:0,&quot;rate&quot;:0,&quot;rate_type&quot;:null,&quot;rate_active&quot;:0,&quot;email_verified_at&quot;:null,&quot;created_at&quot;:&quot;2023-09-04T07:20:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2024-01-06T05:07:04.000000Z&quot;,&quot;photo&quot;:null,&quot;show_department_products&quot;:null,&quot;is_dentist&quot;:null,&quot;is_dermatologist&quot;:null,&quot;deleted_at&quot;:null,&quot;monthly_income_from_invoices&quot;:0,&quot;monthly_discounts&quot;:0},&quot;invoices&quot;:[{&quot;id&quot;:64,&quot;invoice_number&quot;:&quot;64&quot;,&quot;patient_id&quot;:43,&quot;animal_id&quot;:null,&quot;employee_id&quot;:1,&quot;total&quot;:69,&quot;discount&quot;:0,&quot;tax&quot;:9,&quot;created_at&quot;:&quot;2024-05-07T05:04:03.000000Z&quot;,&quot;updated_at&quot;:&quot;2024-05-07T05:04:03.000000Z&quot;,&quot;status&quot;:&quot;cash&quot;,&quot;dr_id&quot;:13,&quot;department_id&quot;:1,&quot;amount&quot;:60,&quot;cash&quot;:69,&quot;card&quot;:0,&quot;rest&quot;:0,&quot;notes&quot;:null,&quot;offers_discount&quot;:0,&quot;using_points&quot;:null,&quot;visa&quot;:0,&quot;mastercard&quot;:0,&quot;installment_company&quot;:0,&quot;installment_company_tax&quot;:null,&quot;installment_company_max_amount_tax&quot;:null,&quot;installment_company_min_amount_tax&quot;:null,&quot;installment_company_rest&quot;:null,&quot;tab&quot;:0,&quot;bank&quot;:0,&quot;entry_date&quot;:null,&quot;departure_date&quot;:null,&quot;is_lab&quot;:0,&quot;lab_user_id&quot;:null,&quot;paid_tax&quot;:0,&quot;paid_without_tax&quot;:0,&quot;tamara&quot;:0,&quot;tabby&quot;:0,&quot;paid&quot;:69,&quot;num_of_days&quot;:0},{&quot;id&quot;:65,&quot;invoice_number&quot;:&quot;65&quot;,&quot;patient_id&quot;:43,&quot;animal_id&quot;:52,&quot;employee_id&quot;:1,&quot;total&quot;:37.95,&quot;discount&quot;:0,&quot;tax&quot;:4.95,&quot;created_at&quot;:&quot;2024-05-08T10:54:45.000000Z&quot;,&quot;updated_at&quot;:&quot;2024-05-08T11:02:21.000000Z&quot;,&quot;status&quot;:&quot;Unpaid&quot;,&quot;dr_id&quot;:13,&quot;department_id&quot;:1,&quot;amount&quot;:33,&quot;cash&quot;:37.95,&quot;card&quot;:0,&quot;rest&quot;:0,&quot;notes&quot;:null,&quot;offers_discount&quot;:0,&quot;using_points&quot;:null,&quot;visa&quot;:0,&quot;mastercard&quot;:0,&quot;installment_company&quot;:0,&quot;installment_company_tax&quot;:null,&quot;installment_company_max_amount_tax&quot;:null,&quot;installment_company_min_amount_tax&quot;:null,&quot;installment_company_rest&quot;:null,&quot;tab&quot;:0,&quot;bank&quot;:0,&quot;entry_date&quot;:null,&quot;departure_date&quot;:null,&quot;is_lab&quot;:1,&quot;lab_user_id&quot;:null,&quot;paid_tax&quot;:0,&quot;paid_without_tax&quot;:0,&quot;tamara&quot;:0,&quot;tabby&quot;:0,&quot;paid&quot;:37.95,&quot;num_of_days&quot;:0}],&quot;city&quot;:{&quot;id&quot;:1,&quot;name&quot;:&quot;\u0627\u0644\u0631\u064a\u0627\u0636&quot;,&quot;created_at&quot;:&quot;2023-09-04T07:20:31.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-09-04T07:20:31.000000Z&quot;}})">نعم</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

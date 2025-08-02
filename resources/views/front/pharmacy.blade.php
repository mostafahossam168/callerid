@extends('front.layouts.front')
@section('title')
{{ __('admin.Notifications') }}
@endsection
@section('content')
<section class="main-section home">
    <div class="container">
        <ul class="nav nav-tabs d-flex flex-wrap gap-2 align-items-center" id="pills-tab" role="tablist" style="flex-wrap: wrap !important;">
            <li class="nav-item" role="presentation">
                <button class="main-head btn-head active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">الصيدلية</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="main-head btn-head" id="pills-storage-tab" data-bs-toggle="pill" data-bs-target="#pills-storage" type="button" role="tab" aria-controls="pills-storage" aria-selected="false">المخزن</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="main-head btn-head" id="pills-medical-tab" data-bs-toggle="pill" data-bs-target="#pills-medical" type="button" role="tab" aria-controls="pills-medical" aria-selected="false">الادوية</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="main-head btn-head" id="pills-types-tab" data-bs-toggle="pill" data-bs-target="#pills-types" type="button" role="tab" aria-controls="pills-types" aria-selected="false">الانواع</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="main-head btn-head" id="pills-danger-tab" data-bs-toggle="pill" data-bs-target="#pills-danger" type="button" role="tab" aria-controls="pills-danger" aria-selected="false">الخطورة</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class=" main-tab-content border-0 pt-3 px-2 pb-0">
                    <h4 class="small-heading mb-3">الاحصائيات الخاصه بالصيدلية</h4>
                    <div class="row g-3 mb-4 boxes-info">
                        <div class="col-sm-6 col-lg-4">
                            <a href="">
                                <div class="box-info blue">
                                    <i class="fa-solid fa-box-archive bg-icon"></i>
                                    <div class="num">0</div>
                                    <div class="text">المخازن </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a href="">
                                <div class="box-info green">
                                    <i class="fa-solid fa-suitcase-medical bg-icon"></i>
                                    <div class="num">0
                                    </div>
                                    <div class="text">كل الادوية</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a href="">
                                <div class="box-info red">
                                    <i class="fa-solid fa-capsules bg-icon"></i>
                                    <div class="num">0</div>
                                    <div class="text">ادوية غير متوفرة</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a href="">
                                <div class="box-info green">
                                    <i class="fa-solid fa-pills bg-icon"></i>
                                    <div class="num">0
                                    </div>
                                    <div class="text">ادوية منتهي الصلاحية</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a href="">
                                <div class="box-info pur">
                                    <i class="fa-solid fa-user-doctor bg-icon"></i>
                                    <div class="num">0</div>
                                    <div class="text">كل الوصفات</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-storage" role="tabpanel" aria-labelledby="pills-storage-tab" tabindex="0">
                <div class="main-tab-content border-0 pt-3 px-2 pb-0">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="small-heading mb-3">اخر المخازن</h4>
                            <div class="d-flex">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    اضافة
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <th>المخزن</th>
                                    <th>المخزن الفرعي</th>
                                    <th>عدد الادوية</th>
                                    <th>الادوية</th>
                                    <th>التحكم</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-success btn-sm">عرض</button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                                <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة المخزن</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">المخزن الرئيسي</label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">المخزن الفرعي</label>
                                                <select name="" class="w-100 form-select" id="">
                                                    <option value="">اختر المخزن الفرعي</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                                    <button type="button" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-medical" role="tabpanel" aria-labelledby="pills-medical-tab" tabindex="0">
                <div class="main-tab-content border-0 pt-3 px-2 pb-0">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="small-heading mb-3">اخر الادوية</h4>
                            <div class="d-flex">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#medical">
                                    اضافة
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="medical" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة دواء</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">اسم العلاج</label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">الاسم العلمي </label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">الباركود</label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">النوع</label>
                                                <select name="" class="w-100 form-select" id="">
                                                    <option value="">اختر النوع</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">الخطورة</label>
                                                <select name="" class="w-100 form-select" id="">
                                                    <option value="">اختر الخطورة</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">رصيد الافتتاح</label>
                                                <input type="number" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">المصروفات</label>
                                                <input type="number" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">سعر الشراء</label>
                                                <input type="number" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">سعرالبيع</label>
                                                <input type="number" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">تاريخ الانتهاء</label>
                                                <input type="date" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                                    <button type="button" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <th>#</th>
                                    <th>اسم العلاج</th>
                                    <th>الاسم العلمي</th>
                                    <th>الباركود</th>
                                    <th>النوع</th>
                                    <th>الخطورة</th>
                                    <th>رصيد الافتتاح</th>
                                    <th>@lang('Current quantity')</th>
                                    <th>المصروفات</th>
                                    <th>سعر الشراء</th>
                                    <th>سعرالبيع</th>
                                    <th>تاريخ الانتهاء</th>
                                    <th>التحكم</th>
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
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="" class="btn btn-primary btn-sm"><i class="fa-solid fa-eye"></i></a>
                                                <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                                <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-types" role="tabpanel" aria-labelledby="pills-types-tab" tabindex="0">
                <div class="main-tab-content border-0 pt-3 px-2 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="small-heading mb-3">الانواع</h4>
                        <div class="d-flex">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#type">
                                اضافة
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="type" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة نوع</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">الاسم</label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                                    <button type="button" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>التحكم</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                                <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-danger" role="tabpanel" aria-labelledby="pills-danger-tab" tabindex="0">
                <div class="main-tab-content border-0 pt-3 px-2 pb-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="small-heading mb-3">الخطورة</h4>
                        <div class="d-flex">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#danger">
                                اضافة
                            </button>
                        </div>
                    </div>
                    <div class="modal fade" id="danger" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">اضافة خطر</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="collectData-box mb-2">
                                                <label for="" class="small-label mb-1">الاسم</label>
                                                <input type="text" id="" class="w-100 form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                                    <button type="button" class="btn btn-success">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="latestAppointments-content bg-white p-3 rounded-2 shadow">
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <th>#</th>
                                    <th>الاسم</th>
                                    <th>التحكم</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>--</td>
                                        <td>--</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="" class="btn btn-info btn-sm"><i class="fa-solid fa-pen"></i></a>
                                                <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </td>
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

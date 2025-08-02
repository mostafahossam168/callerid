@extends('doctor.layouts.index')
@section('title')
عرض وصفة طبية
@endsection
@section('content')
<section class="main-section users">
    <div class="container" id="data-table">
        <div class="bg-white shadow p-4 rounded-3">
            <div id="prt-content">
                <div class="d-flex align-items-center gap-1 flex-wrap mb-3">
                <span class="badge bg-success fs-14 py-2">مقبول</span>
                    <h4 class="main-heading mb-0 mx-auto">الوصفة الطبية رقم: <span class="text-primary">5</span></h4>
                    <button class="btn btn-sm btn-warning not-print" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
                <div class="box-invoice">
                    <div class="row">
                        <div class="col-md-4 p-3">
                            <p>
                                <b> {{ setting()->site_name }}</b>
                            </p>
                            <p><b>الرقم الضريبي: {{ setting()->tax_no }}</b></p>
                            <p><b>العنوان: {{ setting()->address }}</b></p>
                            <p>
                                <b> البريد الالكتروني: --</b>
                            </p>
                        </div>
                        <div class="text-center col-md-4 p-3 d-flex align-items-center justify-content-center">
                            <img class="img-fluid" src="{{ display_file(setting()->logo) }}" alt="" width="130" />
                        </div>
                        <div class="col-md-4 p-3">
                            <p><b>الجوال: --</b></p>
                        </div>
                    </div>
                </div>
                <div class="row g-4 row-cols-1 row-cols-md-3 row-cols-lg-5 mb-3">
                    <div class="col text-center">
                        <label for="" class="title-bg">المالك</label>
                        <input type="text" disabled value="عبدالله احمد" name="" id=""
                            class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">الأليف</label>
                        <input type="text" disabled value="ميو" name="" id=""
                            class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">السلالة</label>
                        <input type="text" disabled value="ميو" name="" id=""
                            class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            العمر
                        </label>
                        <input type="text" disabled name="" id="" class="form-control">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            التاريخ
                        </label>
                        <input type="text" disabled name="" id="" class="form-control">
                    </div>
                </div>
                <div class="row g-4 mb-3">
                    <div class="col-12 text-center">
                        <label for="" class="title-bg">الوصفة الطبية</label>
                    </div>

                </div>
                <div class="row g-4 row-cols-1 row-cols-md-3 row-cols-lg-4 mb-3">
                    <div class="col text-center">
                        <label for="" class="title-bg">اسم العقار</label>
                        <input type="text" disabled value="" name="" id=""
                            class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                            الجرعات
                        </label>
                        <input type="text" disabled name="" id="" class="form-control">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">التكرار/المعدل</label>
                        <input type="text" disabled name="" id=""
                            class="form-control-sm form-control text-center">
                    </div>
                    <div class="col text-center">
                        <label for="" class="title-bg">
                        المدة
                        </label>
                        <input type="text" disabled name="" id="" class="form-control">
                    </div>
                </div>
                <div class="d-flex  justify-content-between gap-3 flex-column flex-sm-row align-items-start align-items-sm-center">
                    <div class="d-flex flex-column gap-2 align-items-start">
                        <div>
                            <b>أسم الصيدلي:</b>
                            Dr.Hanan
                        </div>
                        <div>
                            <b>توقيع الصيدلي:</b>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2 align-items-start align-items-sm-end">
                        <div>
                            <b>أسم الطبيب:</b>
                            Dr.Hanan
                        </div>
                        <div>
                            <b>توقيع الطبيب:</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

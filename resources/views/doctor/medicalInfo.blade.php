@extends('doctor.layouts.index')
@section('title')
معلومات طبية
@endsection
@section('content')
<section class="main-section users">
  <div class="container">
    <h4 class="main-heading">{{ __('admin.View patient') }}</h4>
    <div class="row row-gap-24">
      <div class="col-lg-3">
        <div class="list-group main-list-group">
          <button type="button" class="list-group-item list-group-item-action active">
            {{ __('admin.Patient data') }}
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            {{__('Patient invoices')}}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            {{ __('admin.Patient appointments') }}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            {{ __('admin.Patient diagnoses') }}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            {{ __('admin.Patient files') }}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action ">
            {{ __('Radiology Requests')}}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action ">
            {{ __('Lap Requests')}}
            <div class="badge-count">
              0
            </div>
          </button>
          <button type="button" class="list-group-item list-group-item-action ">
            {{ __('admin.Contact data') }}
          </button>
          <button type="button" class="list-group-item list-group-item-action">
            معلومات عن المريض
          </button>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="row g-3 mb-3">
          <div class="col-md-2 text-center">
            <label for="" class="small-label mb-2">العلامات الحيوية</label>
            <div class="d-flex flex-column gap-3 justify-content-center">
              <div class="inp-holder">
                <input type="number" name="" id="" class="form-control" placeholder="معدل السكر">
              </div>
              <div class="inp-holder">
                <input type="number" name="" id="" class="form-control" placeholder="معدل الضغط">
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <label for="" class="small-label mb-2">{{__('admin.Diagnosis')}}</label>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 90px"></textarea>
              <label for="floatingTextarea2">{{__('admin.Diagnosis')}}</label>
            </div>
          </div>
          <div class="col-md-5">
            <label for="" class="small-label mb-2">الاجراء المتخذ</label>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 90px"></textarea>
              <label for="floatingTextarea2">الاجراء المتخذ</label>
            </div>
          </div>
          <div class="col-md-12 d-flex justify-content-end">
            <button class="btn btn-sm btn-primary px-5">{{ __('admin.save') }}</button>
          </div>
        </div>
        <hr class="m-0">
        <p class="my-2 text-center">معلومات طبية</p>
        <hr class="m-0">
        <h6 class="small-heading my-3 fw-normal">الامراض المزمنة</h6>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="check-holder d-flex flex-wrap align-items-center gap-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  امراض الدم او السيولة
                  / Diseases of the blood or fluidity
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  ارتفاع ضغط الدم
                  / Hypertension
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  امراض القلب
                  / heart disease
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  مرض السكري
                  / diabetes
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  الالتهاب الكبدي
                  / Hepatitis
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  الايدز
                  / AIDS
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  الجلطات الدماغية
                  / Strokes
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  الدرن
                  / tuberculosis
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  الصرع
                  / epilepsy
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  امراض الكلي
                  / Kidney disease
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  امراض نفسية
                  / Psychiatric illness
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  فقر الدم
                  / Anemia
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  السرطان
                  / cancer
                </label>
              </div>
            </div>
          </div>
        </div>

        <h6 class="small-heading my-3 fw-normal">العادات المنتظمة</h6>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="check-holder d-flex flex-wrap align-items-center gap-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  اكل اللحوم
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  تناول الفواكه و الخضروات
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  التدخين
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label text-nowrap" for="flexCheckDefault">
                  اخري
                </label>
              </div>
            </div>
          </div>
        </div>
        <h6 class="small-heading my-3 fw-normal">الحمل</h6>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="check-holder d-flex flex-wrap align-items-center gap-2">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  {{__('admin.Yes') }}
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                  لا
                </label>
              </div>
            </div>
          </div>
        </div>
        <h6 class="small-heading my-3 fw-normal">نتائج تحاليل سابقة</h6>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupFile01"><i class="fa-solid fa-upload"></i></label>
              <input type="file" class="form-control" id="inputGroupFile01">
            </div>
          </div>
        </div>
        <!-- <h6 class="small-heading my-3 fw-normal">{{__("admin.Allergies")}}</h6>
        <div class="row">
          <div class="col-12 col-md-12">
            <div class="check-holder d-flex flex-wrap align-items-center gap-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="">
                <label class="form-check-label text-nowrap" for="">
                  دواء
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="">
                <label class="form-check-label text-nowrap" for="">
                  طعام
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="">
                <label class="form-check-label text-nowrap" for="">
                  مادة
                </label>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row my-3">
          <div class="col-12 col-md-6 col-lg-4">
            <table class="table main-table">
              <thead>
                <tr>
                  <th></th>
                  <th width="90%">{{__("admin.Vaccinations")}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="" style="background-color: #f9fafb; vertical-align: middle;">
                    <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                  </td>
                  <td><input type="text" name="" id="" class="form-control" placeholder="{{__("admin.Type the name of the vaccination")}}"></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <div class="table-responsive">
              <table class="table main-table">
                <thead>
                  <tr>
                    <th></th>
                    <th width="90%">{{__("admin.Allergies")}}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="background-color: #f9fafb; vertical-align: middle;">
                      <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                    </td>
                    <td><input type="text" name="" id="" class="form-control" placeholder="اكتب اسم {{__("admin.Allergies")}}"></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <table class="table main-table">
              <thead>
                <tr>
                  <th></th>
                  <th width="90%">الدواء</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="background-color: #f9fafb; vertical-align: middle;">
                    <button class="btn btn-primary"><i class="fa-solid fa-plus"></i></button>
                  </td>
                  <td><input type="text" name="" id="" class="form-control" placeholder="اكتب اسم الدواء"></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <h6 class="small-heading my-3 fw-normal">الفحص السريري</h6>
        <div class="row g-2">
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">درجة الحرارة</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">معدل النبض</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">{{__('admin.breathing_rate')}}</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">ضغط الدم</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">قياس السكر</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">الراس و الرقبة</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">البطن</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">الصدر و الظهر</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">الاطراف العلوية و السفلية</label>
            <input type="number" name="" id="" class="form-control">
          </div>
          <div class="col-12 col-md-3 col-lg-2">
            <label for="" class="small-label">الحوض</label>
            <input type="number" name="" id="" class="form-control">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

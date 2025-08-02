@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Settings') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Settings') }}</li>
        </ol>
    </nav>
    <div class="row g-3">
        <div class="col-12 col-md-3 ">
            <div class="profile-bar">
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills list-option" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <button class="nav-link active" type="button" aria-selected="true" data-bs-toggle="tab"
                            data-bs-target="#nav-settings" type="button" role="tab" aria-controls="nav-settings">
                            <div class="name">
                                <i class="fa-solid fa-gear"></i>
                                الاعدادات
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="false" data-bs-toggle="tab"
                            data-bs-target="#nav-work" type="button" role="tab" aria-controls="nav-work">
                            <div class="name">
                                <i class="fas fa-clock"></i>
                                مواعيد العمل
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="false" data-bs-toggle="tab"
                            data-bs-target="#nav-program" type="button" role="tab" aria-controls="nav-program">
                            <div class="name">
                                <i class="fa-solid fa-tablet-screen-button"></i>
                                خيارات البرنامج
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="false" data-bs-toggle="tab"
                            data-bs-target="#nav-pay" type="button" role="tab" aria-controls="nav-pay">
                            <div class="name">
                                <i class="fa-solid fa-money-check-dollar"></i>
                                شركات التقسيط
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="false" data-bs-toggle="tab"
                            data-bs-target="#nav-sms" type="button" role="tab" aria-controls="nav-sms">
                            <div class="name">
                                <i class="fas fa-comment"></i>
                                اعدادت الـsms
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                        <button class="nav-link " type="button" aria-selected="false" data-bs-toggle="tab"
                            data-bs-target="#nav-whatsapp" type="button" role="tab" aria-controls="nav-whatsapp">
                            <div class="name">
                                <i class="fa-brands fa-whatsapp"></i>
                                اعدادت Whatsapp
                            </div>
                            <i class="fa-solid fa-angle-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9 ">

            <div class="tab-content" id="nav-tabContent">
                <div class="content_view">
                    <div class="content_header">
                        <div class="title fs-11px">
                            <i class="fa-solid fa-gear fs-12px main-red-color"></i>
                            الاعدادات
                        </div>
                    </div>
                    <form class="row row-gap-24 p-3 shadow rounded-3 bg-white w-100 mx-auto"
                        action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-settings" role="tabpanel"
                                aria-labelledby="nav-settings-tab" tabindex="0">
                                <div class="row row-gap-24 ">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Site name') }}</label>
                                        <input type="text" name="site_name" placeholder="{{ __('admin.Site name') }}"
                                            class="form-control" value="{{ setting()->site_name }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.url') }}</label>
                                        <input type="url" name="url" placeholder="{{ __('admin.url') }}"
                                            class="form-control" value="{{ setting()->url }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.SMS status') }}</label>
                                        <select name="sms_status" id="" class="main-select w-100">
                                            <option value="open"
                                                {{ setting()->sms_status == 'open' ? 'selected' : '' }}>
                                                {{ __('admin.open') }}
                                            </option>
                                            <option value="close"
                                                {{ setting()->sms_status == 'close' ? 'selected' : '' }}>
                                                {{ __('admin.close') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.phone') }}</label>
                                        <input type="text" name="phone" placeholder="{{ __('admin.phone') }}"
                                            class="form-control" value="{{ setting()->phone }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.SMS Username') }}</label>
                                        <input type="text" name="sms_username"
                                            placeholder="{{ __('admin.SMS Username') }}" class="form-control"
                                            value="{{ setting()->sms_username }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.SMS Sender') }}</label>
                                        <input type="text" name="sms_sender"
                                            placeholder="{{ __('admin.SMS Sender') }}" class="form-control"
                                            value="{{ setting()->sms_sender }}">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.SMS Password') }}</label>
                                        <input type="text" name="sms_password"
                                            placeholder="{{ __('admin.SMS Password') }}" class="form-control"
                                            value="{{ setting()->sms_password }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.email') }}</label>
                                        <input type="email" name="email" placeholder="{{ __('admin.email') }}"
                                            class="form-control" value="{{ setting()->email }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Tax enabled') }}</label>
                                        <select name="tax_enabled" id="" class="main-select w-100">
                                            <option value="1" {{ setting()->tax_enabled == 1 ? 'selected' : '' }}>
                                                {{ __('admin.Yes') }}</option>
                                            <option value="0" {{ setting()->tax_enabled == 0 ? 'selected' : '' }}>
                                                {{ __('admin.لا') }}</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">المستودع الرئيسي للصيدلية</label>
                                        <select name="main_pharmacy_warehouse_id" id=""
                                            class="main-select w-100">
                                            <option value=''>اختر</option>
                                            @foreach (\App\Models\PharmacyWarehouse::get() as $warehouse)
                                                <option
                                                    {{ setting()->main_pharmacy_warehouse_id == $warehouse->id ? 'selected' : '' }}
                                                    value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Tax rate') }}</label>
                                        <input type="number" name="tax_rate" placeholder="{{ __('admin.Tax rate') }}"
                                            class="form-control" value="{{ setting()->tax_rate }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Tax number') }}</label>
                                        <input type="text" name="tax_no" placeholder="{{ __('admin.Tax number') }}"
                                            class="form-control" value="{{ setting()->tax_no }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.address') }}</label>
                                        <input type="text" name="address" placeholder="{{ __('admin.address') }}"
                                            class="form-control" value="{{ setting()->address }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Build number') }}</label>
                                        <input type="text" name="build_num"
                                            placeholder="{{ __('admin.Build number') }}" class="form-control"
                                            value="{{ setting()->build_num }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Unit number') }}</label>
                                        <input type="text" name="unit_num"
                                            placeholder="{{ __('admin.Unit number') }}" class="form-control"
                                            value="{{ setting()->unit_num }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Postal code') }}</label>
                                        <input type="text" name="postal_code"
                                            placeholder="{{ __('admin.Postal code') }}" class="form-control"
                                            value="{{ setting()->postal_code }}">
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Extra number') }}</label>
                                        <input type="text" name="extra_number"
                                            placeholder="{{ __('admin.Extra number') }}" class="form-control"
                                            value="{{ setting()->extra_number }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('capital') }} </label>
                                        <input type="number" name="capital" placeholder="{{ __('capital') }}"
                                            class="form-control" value="{{ setting()->capital }}">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">حالة الموقع</label>
                                        <select name="status" id="" class="main-select w-100">
                                            <option value="open" {{ setting()->status == 'open' ? 'selected' : '' }}>
                                                {{ __('مفتوح') }}
                                            </option>
                                            <option value="close" {{ setting()->status == 'close' ? 'selected' : '' }}>
                                                {{ __('مغلق') }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-12 m-0">
                                        <hr class="m-0 bg-transparent">
                                    </div>
                                    <?php $setting = \App\Models\Setting::latest()->first(); ?>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Logo') }}</label>
                                        <input type="file" name="logo" placeholder="{{ __('admin.Logo') }}"
                                            class="form-control img" value="{{ $setting->logo ?? null }}">
                                        <img src="{{ display_file(setting()->logo) }}"
                                            alt="{{ $setting->logo ?? null }}" class="img-thumbnail img-preview"
                                            width="100px">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">{{ __('admin.Icon') }}</label>
                                        <input type="file" name="icon" placeholder="{{ __('admin.Icon') }}"
                                            class="form-control">
                                        <img src="{{ display_file(setting()->icon) }}"
                                            alt="{{ $setting->icon ?? null }}" class="img-thumbnail img-preview"
                                            width="100px">
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <label class="main-lable" for="">{{ __('admin.Message status') }}</label>
                                        <textarea name="message_status" rows="5" class="form-control" placeholder="{{ __('admin.Message status') }}">{{ setting()->message_status }}</textarea>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab"
                                tabindex="0">
                                <div class="row row-gap-24">
                                    <div class="col-md-12 text-center mt-3">
                                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">
                                            {{ __('admin.Morning and evening settings') }}</h5>
                                    </div>
                                    <div class="col-12 col-12 m-0">
                                        <div class="alert alert-info" role="alert">
                                            يجب ضبط الوقت ليتم تحديد المواعيد بناءا على مواعيد العمل
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h6 class="text-center mb-3">{{ __('admin.Morning time') }}</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="main-lable" for="">{{ __('admin.from') }}</label>
                                                <input type="time" required name="from_morning" class="form-control"
                                                    value="{{ setting()->from_morning }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="main-lable" for="">{{ __('admin.To') }}</label>
                                                <input type="time" required name="to_morning" class="form-control"
                                                    value="{{ setting()->to_morning }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <h6 class="text-center mb-3">{{ __('admin.Evening time') }}</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="main-lable" for="">{{ __('admin.from') }}</label>
                                                <input type="time" required name="from_evening" class="form-control"
                                                    value="{{ setting()->from_evening }}">

                                            </div>
                                            <div class="col-md-6">
                                                <label class="main-lable" for="">{{ __('admin.To') }}</label>
                                                <input type="time" required name="to_evening" class="form-control"
                                                    value="{{ setting()->to_evening }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-program" role="tabpanel"
                                aria-labelledby="nav-program-tab" tabindex="0">
                                <div class="row row-gap-24">

                                    <div class="col-md-12 text-center">
                                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">خيارات التفعيل</h5>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3 col-lg-2">
                                        <input type="checkbox" name="activate_medicines" value="1"
                                            {{ setting()->activate_medicines ? 'checked' : '' }}>
                                        <label class="small-label" for="">تفعيل الأدوية</label>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3 col-lg-2">
                                        <input type="checkbox" name="active_scan_and_lab" value="1"
                                            {{ setting()->active_scan_and_lab ? 'checked' : '' }}>
                                        <label class="small-label" for="">تفعيل الأشعة</label>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                        <input type="checkbox" name="new_invoice_form" value="1"
                                            {{ setting()->new_invoice_form ? 'checked' : '' }}>
                                        <label class="small-label" for="new_invoice_form">تفعيل الطابعة الحرارية</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3 col-lg-3">
                                        <input type="checkbox" name="active_transfer_print" value="1"
                                            {{ setting()->active_transfer_print ? 'checked' : '' }}>
                                        <label class="small-label" for="active_transfer_print">تفعيل طباعه تحويل
                                            المريض</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3 col-lg-5">
                                        <input type="checkbox" name="complaint" value="1"
                                            {{ setting()->complaint ? 'checked' : '' }}>
                                        <label class="small-label" for="complaint">إظهار حقل الشكوى والكشف السريري في
                                            التشخيص</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-4">
                                        <input type="checkbox" name="delete_transfer"
                                            @if (setting()->delete_transfer) checked @endif>
                                        <label class="small-label"
                                            for="delete_transfer">{{ __('admin.Delete transfer patients') }}</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-4">
                                        <input type="checkbox" name="active_tax_info_in_patients" value="1"
                                            {{ setting()->active_tax_info_in_patients ? 'checked' : '' }}>
                                        <label class="small-label" for="active_tax_info_in_patients">تفعيل معلومات الضريبة
                                            عند المالكين</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <input type="checkbox" name="active_number_sim"
                                            {{ setting()->active_number_sim ? 'checked' : '' }}>
                                        <label class="small-label" for="active_number_sim">@lang('Activate the chip number')</label>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-pay" role="tabpanel" aria-labelledby="nav-pay-tab"
                                tabindex="0">
                                <div class="row row-gap-24">
                                    <div class="form-group col-sm-6 col-md-3">
                                        <input type="checkbox" name="active_tamara"
                                            {{ setting()->active_tamara ? 'checked' : '' }}>
                                        <label class="small-label" for="active_tamara">تفعيل تمارا</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <input type="checkbox" name="active_tabby"
                                            {{ setting()->active_tabby ? 'checked' : '' }}>
                                        <label class="small-label" for="active_tabby">تفعيل تابي</label>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <input type="checkbox" name="payment_gateways"
                                            {{ setting()->payment_gateways ? 'checked' : '' }}>
                                        <label class="small-label" for="payment_gateways">تفعيل بوابات الدفع</label>
                                    </div>
                                    <!-- <div class="col-md-12 text-center mt-3">
                                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات شركة تمارا</h5>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">رسوم العمليات الادارية</label>
                                        <input type="number" wire:model="installment_company_tax" placeholder="رسوم العمليات الادارية" class="form-control" step="0.01">
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات شركة تابي</h5>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">رسوم العمليات الادارية</label>
                                        <input type="number" wire:model="tabby_tax" placeholder="رسوم العمليات الادارية" class="form-control" step="0.01">
                                    </div> -->
                                    <div class="d-flex justify-content-center ">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="nav-sms" role="tabpanel" aria-labelledby="nav-sms-tab"
                                tabindex="0">
                                <div class="row row-gap-24">
                                    <div class="alert alert-info" role="alert">
                                        لتفعيل الخدمة يرجى التواصل معنا <a href="https://wa.me/0506499275"
                                            class="text-primary text-decoration-underline">0506499275</a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-whatsapp" role="tabpanel"
                                aria-labelledby="nav-whatsapp-tab" tabindex="0">
                                <div class="row row-gap-24">
                                    <div class="col-md-12 text-center mt-3">
                                        <h5 class="mx-auto w-fit line-bottom-blue mb-4">إعدادات الواتس اب</h5>
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">TOKEN</label>
                                        <input type="text" name="whatsapp_token"
                                            value="{{ setting()->whatsapp_token }}" placeholder="TOKEN"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3">
                                        <label class="main-lable" for="">INSTANCE_ID</label>
                                        <input type="text" name="whatsapp_instance_id"
                                            value="{{ setting()->whatsapp_instance_id }}" placeholder="INSTANCE_ID"
                                            class="form-control">
                                    </div>
                                    <div class="form-group col-sm-6 col-md-3 col-lg-4 d-flex align-items-center gap-1">
                                        <input type="checkbox" class="form-check" name="whatsapp_status" value="1"
                                            {{ setting()->whatsapp_status ? 'checked' : '' }}>
                                        <label class="small-label" for="">
                                            تفعيل خدمة ارسال الرسائل بالواتساب
                                        </label>
                                    </div>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-primary">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!--




    -->
    <div class="col-12 text-center mt-5">

        <form action='{{ route('backup-database') }}' method='post'>
            @csrf
            <button type="submit" class="btn btn-primary">{{ __('admin.export_database') }}</button>
        </form>
    </div>
@endsection

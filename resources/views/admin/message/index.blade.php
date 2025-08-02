@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Settings') }}
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3 ">
        <a href="{{ route('admin.home') }}" class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Settings message') }}</li>
    </ol>
</nav>
<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="alert alert-warning" role="alert">
            لطلب الاشتراك في خدمه الرسائل SMS تواصل معنا <a href="https://wa.me/966506499275" target="_blank" class="text-primary">0506499275
                <i class="fa-brands fa-whatsapp text-success fs-5"></i>
            </a>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('admin.message.setting.store') }}" method="POST">
                        @csrf
                        <div class="row my-4 ">
                            <div class="col-12 col-md-6">
                                <div class="fild-control mb-3">
                                    <input type="text" name="taqnyat_key" value="{{ setting()->taqnyat_key }}" class="form-control" placeholder="مفتاح تقنيات المرسل " />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="fild-control mb-3">
                                    <input type="text" name="taqnyat_sender" value="{{ setting()->taqnyat_sender }}" class="form-control" placeholder="اسم المرسل" />
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="fild-control mb-3">
                                    <input type="hidden" name="taqnyat_status" value="0" id="">
                                    <input type="checkbox" name="taqnyat_status" {{ setting()->taqnyat_status ? 'checked' : '' }} value="1" id="">
                                    <span class="text-{{ setting()->taqnyat_status ? 'success' : 'danger' }}">{{ setting()->taqnyat_status ? 'مفعل' : 'غير مفعل' }}</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                @php
                                $key = setting()->taqnyat_key;
                                $sender = setting()->taqnyat_sender;
                                $taqnyatModules = json_decode((setting()->taqnyat_modules_status ?? ''),true);
                                @endphp
                                @if($key && $sender)
                                @if($balance?->statusCode == 200)
                                <p>الرصيد : <span class="badge bg-primary">{{ ($key && $sender) ? $balance?->balance : 'N/A' }}</span></p>
                                <p>عدد النقاط : <span class="badge bg-primary">{{ ($key && $sender) ? $balance?->points : 'N/A'  }}</span></p>
                                <p>العملة : <span class="badge bg-primary">{{ ($key && $sender) ? $balance?->currency : 'N/A'  }}</span></p>
                                @else
                                <div class="alert alert-danger">
                                    لا يمكن عرض بيانات الحساب
                                    سبب المشكلة : {{ $balance->message }}
                                </div>
                                @endif
                                @endif


                                <p>حالة المنصة : <span class="badge bg-primary">{{ ($key && $sender) ? __($status?->status->description) : 'N/A'  }}</span></p>

                            </div>
                            <div class=" col-sm-12 col-md-12">
                                <div class="form-group  mt-4">
                                    <input type="hidden" name="taqnyat_modules_status[create_appointment]" value="0">
                                    <input type="checkbox" name="taqnyat_modules_status[create_appointment]" value="1" {{ isset($taqnyatModules['create_appointment'])  && $taqnyatModules['create_appointment']  == '1' ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label ms-1" for="">حجز موعد</label>
                                </div>
                                <div class="form-group  mt-4">
                                    <input type="hidden" name="taqnyat_modules_status[reject_appointment]" value="0">
                                    <input type="checkbox" name="taqnyat_modules_status[reject_appointment]" value="1" {{ isset($taqnyatModules['reject_appointment']) && $taqnyatModules['reject_appointment'] == '1' ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label ms-1" for="">{{__('admin.cancel an appointment')}}</label>
                                </div>
                                <div class="form-group  mt-4">
                                    <input type="hidden" name="taqnyat_modules_status[review_appointment]" value="0">
                                    <input type="checkbox" name="taqnyat_modules_status[review_appointment]" value="1" {{ isset($taqnyatModules['review_appointment'])  && $taqnyatModules['review_appointment']  == '1' ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label ms-1" for="">المراجعة</label>
                                </div>
                            </div>
                            <div class="col-12 text-center mt-5">
                                <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

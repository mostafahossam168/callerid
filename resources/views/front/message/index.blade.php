@extends('front.layouts.front')
@section('title')
{{ __('admin.SMS_settings') }}
@endsection
@section('content')

<section class="patinet-report main-section pt-5">
    <div class="container">
        <div class="alert alert-warning" role="alert">
            {{ __('You can request to subscribe to SMS messages by communicating with us, as they are linked to appointments, canceling appointments, sending direct messages, or making advertisements through messages') }}
        </div>
        <div class="d-flex mb-3 align-items-center">
            <a href="{{ route('front.message') }}" class="btn bg-main-color text-white">
                <i class="fas fa-angle-right"></i>
            </a>
            <h4 class="main-heading mb-0 me-2">{{ __('admin.SMS_settings') }}</h4>
        </div>
        <div class="treasuryAccount-content bg-white p-4 rounded-2 shadow">
            <div class="row ">
                <div class="left-holder d-flex justify-content-end m-sm-0 gap-2">
                    <a class="btn btn-sm btn-outline-info" href="">
                        {{ __('Settings message') }}
                    </a>
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <span>?</span>

                    </button>
                </div>
            </div>
            <form action="{{ route('front.message.send') }}" method="POST">
                @csrf
                <div class="row my-4 ">
                    <div class="col-12 col-md-6">
                        <div class="fild-control mb-3">
                            <input type="number" id="my-input"  class="form-control" name="phone" placeholder="{{ __('Phone number') }}" />
                            <small>مطلوب فقط في حالة اختيار مخصص من العملاء</small>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="fild-control mb-3">
                            <select class="gender main-select w-100" id="gender" name="patient_id">
                                <option value="">{{ __('Client') }}</option>
                                <option value="custom">{{ __('Custom') }}</option>
                                @foreach ($patients as $patient)
                                <option value="{{ $patient->phone }}">{{ $patient->name }} - {{ $patient->phone }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 ">
                        <div class="fild-control mb-3">
                            <textarea name="message" id="" cols="" rows="4" class="form-control" placeholder="{{ __('Message') }}"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </div>
                </div>
            </form>
            <!-- <hr> -->
            <!-- <div class="table-responsive mt-3">
                <table class="table main-table" id="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('password') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>


                    </tbody>
                </table>
            </div> -->
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('How To connect to Taqnyat') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <ul>
                        <li>1- اذهب الي منصة الرسائل وقم بتسجيل الدخول <a href="https://portal.taqnyat.sa/">portal.taqnyat.sa</a></li>
                        <li>2- للحصول على المفتاح قم بالذهاب الي المطورين > التطبيقات .. قم بنسخ المفتاح من اي تطبيق تريد استخدامة</li>
                        <li>3- للحصور على اسم المرسل اذهب الي صورة المستخدم اعلي اليسار > الاعدادات > ادارة اسم المرسل قم بنسخ اسم المرسل كما هو بالظبط</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

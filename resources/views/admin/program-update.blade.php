@extends('front.layouts.front')
@section('title')
{{ __('admin.Software updates') }}
@endsection
@section('content')
<section class="main-section section-guide">
    <div class="container">
        <div class="d-flex align-items-center gap-3 felx-wrap  mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.Software updates') }}</h4>
            <div class="d-flex align-items-center gap-1 mx-auto">
                    <a href="{{ route('front.program-update') }}" class="btn btn-info">
                        {{ __('admin.Software updates') }}
                    </a>
                    <a href="{{ route('front.guide') }}" class="btn btn-info">
                        {{ __('admin.Users Manual') }}
                    </a>
            </div>
        </div>
        <!-- <div class="alert alert-warning" role="alert">
        </div> -->
        <div class="bg-white shadow p-4 rounded-3">
            <p>
                {{ __('admin.SMS messaging service') }}
            </p>
            <div class="accordion mt-3">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-massage" aria-expanded="false" aria-controls="collapse-massage">
                            {{ __('admin.The text messaging service has been added to the system so that it works on:') }}
                        </button>
                    </h2>
                    <div id="collapse-massage" class="accordion-collapse  collapse">
                        <div class="accordion-body">
                            <div class="row gx-3">
                                <div class="col-12 col-md-8">
                                    <p>
                                        - {{ __('admin.Send new appointment data') }}.
                                    </p>
                                    <p>
                                        - {{ __('admin.cancel an appointment') }}.
                                    </p>
                                    <p>
                                        - {{ __('admin.Sending offers about doctors visits or any other offers') }}.
                                    </p>
                                    <p>
                                        {{ __('admin.You can request the service by contacting us via WhatsApp or calling') }}<a href="tel:0506499275" class="text-primary">0506499275</a>
                                    </p>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="image-holder">
                                        <img src="{{ asset('img/phone-smg.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-tax" aria-expanded="false">
                            {{ __('Customer tax data') }}
                        </button>
                    </h2>
                    <div id="collapse-tax" class="accordion-collapse  collapse">
                        <div class="accordion-body">
                            <p class="mb-0">
                                {{ __('The owner\'s tax data has been added and can be activated from the Admin control panel > Settings') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-whatsapp" aria-expanded="false">
                            {{ __('Send invoice on WhatsApp') }}
                        </button>
                    </h2>
                    <div id="collapse-whatsapp" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p class="mb-0">
                                {{ __('The invoice has been sent via WhatsApp to the owner and can be viewed via the link and downloaded in PDF') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-analysis_departments" aria-expanded="false">
                            المختبر البيطري
                        </button>
                    </h2>
                    <div id="collapse-analysis_departments" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p class="mb-0">
                                يتوفر مختبر بيطري خاص بالحيونات مستقل وفيه كل اقسام التحليل لكل انواع الحيونات مع امكانية طباعة النتائج وتصديرها وارسالها للمالك عبر الواتس اب ..ايضا يوجد تطوير وتعديل في حال الرغبة للطلب والمعاينه التواصل أتصال او واتس اب <a href="https://wa.me/0506499275" class="text-primary text-decoration-underline">0506499275</a> </p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Veterinary_pharmacy" aria-expanded="false">
                            @lang('Veterinary pharmacy system')
                        </button>
                    </h2>
                    <div id="collapse-Veterinary_pharmacy" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <p class="mb-0">
                                @lang('The veterinary pharmacy system is available, where medications can be added with expiry dates and quantities, with the possibility of giving a prescription by the doctor, entering the pharmacist and making the dispensing, while following up on the reports. You can contact me via call or WhatsApp')
                                <a href="https://wa.me/0506499275" class="text-primary text-decoration-underline">0506499275</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

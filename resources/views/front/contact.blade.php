@extends('front.layouts.front')
@section('content')
<section class="main-section section-contact ">
    <div class="container">
        <h4 class="main-heading">أتصل بنا</h4>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session()->get('success') }}
        </div>
        @endif

        <div class="form_section mb-4">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="contact-title">
                        <h3>ابق على تواصل معنا</h3>
                        <p>
                            شركات إدارة سلسلة التوريد الرائدة في العالم غير القائمة على
                            الأصول ، نقوم بتصميم وتنفيذ صناعة رائدة. نحن متخصصون في البحث
                            الذكي والفعال ونؤمن بالأعمال.
                        </p>
                    </div>
                    <div>
                        <form class="form-contact" action="{{route('contact.store')}}" method="post">
                            @csrf
                            <div class="controls">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="form_name" type="text" name="name" class="form-control custom-form" placeholder="*@lang("Name")" />

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input id="form_email" type="email" name="email" class="form-control custom-form" placeholder="*البريد الاليكتروني" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="tel" name="phone" class="form-control custom-form" placeholder="*رقم الهاتف" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea id="form_message" name="message" class="form-control message-form custom-form" placeholder="*رسالتك" rows="6"></textarea>


                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-12 btn-send">
                                        <p>
                                            <input type="submit" class="btn btn-washla" value="ارسل رسالتك" />
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="contact_way">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="box-content">
                        <div class="icon_holder">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <p class="mb-0">السعودية - الرياض</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content">
                        <div class="icon_holder">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <p class="mb-0" dir="ltr"> 0525959</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="box-content">
                        <div class="icon_holder">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <p class="mb-0" dir="ltr"> admin@admin.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
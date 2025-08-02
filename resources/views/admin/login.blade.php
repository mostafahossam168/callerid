@include('front.layouts.head')
@if (session()->has('error'))
<div class="alert alert-danger" role="alert">
    {{ session()->get('error') }}
</div>
@endif




<section class="page-login">
                <form class="form-login" action="{{ route('admin.login.post') }}" method="POST">
                    @csrf
                    <div class="box-login">
                        <div class="img-login">
                            <img src="{{ asset('img/login/login-office.jpeg') }}" alt="">
                        </div>
                        <div class="content-login">
                            <div class="w-100">
                                <div class="badge-text mx-auto mb-3 w-100 ">
                                    لوحة الادارة
                                </div>
                                <h3 class="title"> تسجيل الدخول</h3>

                                    <div class="lable">البريد الالكتروني</div>
                                    <input name="email" type="email" class="form-control" placeholder="البريد الالكتروني" />

                                    <div class="lable mt-3">كلمة السر</div>
                                    <input name="password" type="password" class="form-control" placeholder="كلمة السر" required />
                                    <!-- <div class="lable mt-3">الدخول كا</div> -->

                                <button class="btn sub" type="submit">
                                    دخول
                                </button>
                                <hr class="my-4">
                                <div class="d-flex align-items-center justify-content-center">
                                    {{__('admin.Programming_and_development_of_Tech_Constellation')}}
                                    <img src="{{ asset('img/login/LOGO3.png') }}" alt="" class="logo-footer">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
</section>


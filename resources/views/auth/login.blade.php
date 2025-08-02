@include('front.layouts.parts.head')
@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    {{$error}}
</div>
@endforeach
@endif

<section class="loginPage py-5">
    <div class="container">
        <div class="row login_box shadow-lg">
            <div class="col-md-6 px-0">
                <div class="image_holder shadow-sm">
                    <img src="{{asset('front-asset/img/login_bg.png')}}" alt="login image" srcset="">
                </div>
            </div>
            <div class="col-md-6 px-0">
                <form class="form-login" action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="login_content">
                        <h6 class="title">تسجيل الدخول</h6>
                        <div class="inp_holder">
                            <label for="" class="login-label">البريد الاليكتروني</label>
                            <input type="email" class="login-inp form-control" name="email">
                        </div>
                        <div class="inp_holder">
                            <label for="" class="login-label">كلمة السر</label>
                            <input type="password" class="login-inp form-control" name="password">
                        </div>
                        <div class="btn_holder">
                            <button type="submit" class="btn login-btn">تسجيل الدخول</button>
                        </div>
                        <a href="" class="mt-2  d-block">
                            ليس لديك عضوية ؟
                        </a>
                        <a href="" class=" d-block">
                            استعادة @lang("Password")
                        </a>
                        <hr class="my-4">
                        <div class="login_footer d-flex align-items-center justify-content-center">
                            <a href="https://www.const-tech.org/">
                                برمجة وتطوير كوكبة التقنية
                                <img src="{{asset('front-asset/img/login_logo.png')}}" width="60" alt="logo_login">
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
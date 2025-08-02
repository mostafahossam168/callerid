@extends('admin.layouts.admin')
@section('title')
{{ __('admin.home') }}
@endsection
@section('content')
<div class="homePage-content bg-white py-4 px-3">
    <h4 class="main-heading mb-4">برنامج إدارة العيادات</h4>
    <div class="row g-4">
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-blue">
                <div class="bar-name">
                    <h5 class="name">{{__('admin.Owners')}}</h5>
                    <div class="box-icon">
                        <i class="fa fa-wheelchair"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Patient::count()}}</h4>
                <a href="{{route('admin.patients.index')}}" class="more">
                   .. المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-blue">
                <div class="bar-name">
                    <h5 class="name"><th>{{__('admin.Pets')}}</h5>
                    <div class="box-icon">
                        <i class="fa fa-wheelchair"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Animal::count()}}</h4>
                <a href="{{route('admin.patients.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-orange">
                <div class="bar-name">
                    <h5 class="name">الموظفين</h5>
                    <div class="box-icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\User::NotAdmin()->count()}}</h4>
                <a href="{{route('admin.users.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-purple">
                <div class="bar-name">
                    <h5 class="name">مجموعات الموظفين</h5>
                    <div class="box-icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <h4 class="amount">{{\DB::table('roles')->count()}}</h4>
                <a href="{{route('admin.roles.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-main-color">
                <div class="bar-name">
                    <h5 class="name">المشرفين</h5>
                    <div class="box-icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\User::where('type','admin')->count()}}</h4>
                <a href="{{route('admin.users.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-green">
                <div class="bar-name">
                    <h5 class="name">الصفحات الخاصة</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                </div>
                <h4 class="amount">132</h4>
                <a href="#" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-main-color">
                <div class="bar-name">
                    <h5 class="name">النماذج</h5>
                    <div class="box-icon">
                        <i class="fa-brands fa-wpforms"></i>
                    </div>
                </div>
                <h4 class="amount">5</h4>
                <a href="#" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-blue">
                <div class="bar-name">
                    <h5 class="name">اقسام العيادات</h5>
                    <div class="box-icon">
                        <i class="fa fa-list-ol"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Department::count()}}</h4>
                <a href="{{route('admin.departments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-red">
                <div class="bar-name">
                    <h5 class="name">المواعيد الاجمالى</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Appointment::count()}}</h4>
                <a href="{{route('admin.appointments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-orange">
                <div class="bar-name">
                    <h5 class="name">المواعيد بالانتظار</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Appointment::waiting()->count()}}</h4>
                <a href="{{route('admin.appointments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-red">
                <div class="bar-name">
                    <h5 class="name">المواعيد - لم يحضر</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <h4 class="amount">
                    {{\App\Models\Appointment::NotAttend()->count()}}
                </h4>
                <a href="{{route('admin.appointments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-green">
                <div class="bar-name">
                    <h5 class="name">المواعيد - حضر</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Appointment::Examined()->count()}}
                </h4>
                <a href="{{route('admin.appointments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-blue">
                <div class="bar-name">
                    <h5 class="name">المواعيد - مؤكدة</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Appointment::Transferred()->count()}}</h4>
                <a href="{{route('admin.appointments.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-purple">
                <div class="bar-name">
                    <h5 class="name">التشخيصات</h5>
                    <div class="box-icon">
                        <i class="fa fa-wheelchair"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Diagnose::count()}}</h4>
                <a href="{{route('admin.diagnoses.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-main-color">
                <div class="bar-name">
                    <h5 class="name">كل الفواتير</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-copy"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Invoice::count()}}</h4>
                <a href="{{route('admin.invoices.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-blue">
                <div class="bar-name">
                    <h5 class="name">الفواتير المسددة</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-copy"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Invoice::Paid()->count()}}</h4>
                <a href="{{route('admin.invoices.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-red">
                <div class="bar-name">
                    <h5 class="name">الفواتير غير المسددة</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-copy"></i>
                    </div>
                </div>
                <h4 class="amount">{{\App\Models\Invoice::Unpaid()->count()}}</h4>
                <a href="{{route('admin.invoices.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-orange">
                <div class="bar-name">
                    <h5 class="name">الفواتير المسددة - بالبطاقة الائتمانية</h5>
                    <div class="box-icon">
                        <i class="fa-brands fa-cc-mastercard"></i>
                    </div>
                </div>
                <h4 class="amount">
                    {{\App\Models\Invoice::where('cash',0.00)->where('card','>',0.00)->count()}}
                </h4>
                <a href="{{route('admin.invoices.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3">
            <div class="box-data box-green">
                <div class="bar-name">
                    <h5 class="name">الفواتير المسددة - {{__('admin.Cash')}}</h5>
                    <div class="box-icon">
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                    </div>
                </div>
                <h4 class="amount"> {{\App\Models\Invoice::where('card',0.00)->where('cash','>',0.00)->count()}}
                </h4>
                <a href="{{route('admin.invoices.index')}}" class="more">
                    المزيد من المعلومات
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

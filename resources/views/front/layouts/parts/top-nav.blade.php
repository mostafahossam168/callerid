<nav class="top-nav">
    <div class="container">
        <a href="#" class="tog-show" data-show=".top-nav .list-item"><i class="fa-solid fa-bars"></i></a>
        <ul class="list-item">
            <li><a href="{{route('settings')}}">الأعدادات</a></li>
            <li><a href="#">الموظفين</a></li>
            <li><a href="#">الصلاحيات</a></li>
            <li><a href="#">المدن</a></li>
            <li><a href="#">التقارير</a></li>
            <li><a href="{{ route('contact') }}">أتصل بنا</a></li>
        </ul>
        <div class="dropdown-hover" data-show="dropdown-lang">
            <div class="icon-drop">
                <i class="fa-solid fa-user icon"></i>
            </div>
            <p class="text">admin</p>
            <div class="arrow-icon">
                <i class="fa-solid fa-angle-down"></i>
            </div>
            <ul class="listis-item" id="dropdown-lang">
                <li class="item-drop">
                    <a href="{{ route('tickets.index') }}">
                        <p class="text">الدعم الفني</p>
                    </a>
                </li>
                <li class="item-drop">
                    <a href="{{ route('profile') }}">
                        <p class="text">الملف الشخصى</p>
                    </a>
                </li>
                <li class="item-drop">
                    <a href="#">
                        <p class="text">تسجيل الخروج</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

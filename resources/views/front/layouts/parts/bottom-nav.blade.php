<nav class="bottom-nav">
    <div class="container">
        <a href="#" class="tog-show" data-show=".bottom-nav .list-item"><i class="fa-solid fa-bars"></i></a>

        <ul class="list-item">
            <li>
                <a class="item" href="{{route('home')}}">
                    @lang("Home")
                    <i class="i-item fa-solid fa-house"></i>
                </a>
            </li>
            <li>
                <a class="item" href="{{route('users')}}">
                    @lang("Clients")
                    <i class="i-item fa-solid fa-users"></i>
                </a>
            </li>
            <li>
                <a class="item"   href="{{route('contracts')}}">
                    العقود
                    <i class="i-item fa-solid fa-sheet-plastic"></i>
                </a>
            </li>
            <li>
                <a class="item" href="">
                    الفواتير
                    <i class="i-item fa-solid fa-money-check-dollar"></i>
                </a>
            </li>
            <li>
                <div class="dropdown-hover item">
                    <div>
                        السندات
                        <i class="i-item fa-solid fa-bars-progress"></i>
                    </div>
                    <div class="arrow-icon">
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <ul class="listis-item" id="dropdown-lang">
                        <li class="item-drop">
                            <a href="#">
                                <p class="text">سند صرف</p>
                            </a>
                        </li>
                        <li class="item-drop">
                            <a href="#">
                                <p class="text">سند قبض</p>
                            </a>
                        </li>
                        <li class="item-drop">
                            <a href="#">
                                <p class="text">تقارير السندات</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="item" href="{{route('notice')}}">
                    الأشعارات
                    <i class="i-item fa-solid fa-bell"></i>
                    <div class="badge-count">5</div>
                </a>
            </li>
        </ul>
    </div>
</nav>

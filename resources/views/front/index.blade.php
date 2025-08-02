@extends('front.layouts.front')
@section('content')
    <section class="main-section home ">
        <div class="container">
            <h4 class="main-heading">@lang("Home")</h4>
            <div class="row row-gap-24 mb-4 boxes-info">
                <div class=" col-sm-6 col-lg-3">
                    <div class="box-info blue">
                        <i class="fas fa-coins bg-icon"></i>
                        <div class="num">851.00
                        </div>
                        <div class="text">الرصيد الاجمالي</div>
                    </div>
                </div>
                <div class=" col-sm-6 col-lg-3">
                    <div class="box-info green">
                        <i class="fas fa-money-check-alt bg-icon"></i>
                        <div class="num">
                            0.00
                        </div>
                        <div class="text">رصيد المستثمرين
                        </div>
                    </div>
                </div>
                <div class=" col-sm-6 col-lg-3">
                    <div class="box-info pur">
                        <i class="fas fa-file-contract bg-icon"></i>
                        <div class="num">851.00
                        </div>
                        <div class="text">كل العقود</div>
                    </div>
                </div>
                <div class=" col-sm-6 col-lg-3">
                    <div class="box-info red">
                        <i class="fas fa-globe-americas bg-icon"></i>
                        <div class="num">0.00</div>
                        <div class="text">المتاخرات</div>
                    </div>
                </div>
            </div>
            <div class="small-heading">الأقساط المتأخرة والمستحقة</div>
            <div class="table-responsive mb-4">
                <table class="table main-table">
                    <thead>
                    <tr>
                        <th>رقم العقد</th>
                        <th>المستثمر</th>
                        <th>العميل</th>
                        <th>المبلغ</th>
                        <th>المتبقي من الأقساط	</th>
                        <th>تاريخ الاستحقاق
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>#1</td>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                        <td>25 ريال</td>
                        <td>2022/2/2</td>
                    </tr>
                    <tr>
                        <td>#1</td>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                        <td>25 ريال</td>
                        <td>2022/2/2</td>
                    </tr>
                    <tr>
                        <td>#1</td>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                        <td>25 ريال</td>
                        <td>2022/2/2</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="small-heading">آخر العقود</div>
            <div class="table-responsive ">
                <table class="table main-table">
                    <thead>
                    <tr>
                        <th>المستثمر</th>
                        <th>العميل</th>
                        <th>المبلغ</th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                    </tr>
                    <tr>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                    </tr>
                    <tr>
                        <td>باسم</td>
                        <td>باسم</td>
                        <td>50 ريال</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection

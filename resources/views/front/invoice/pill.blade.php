@extends('front.layouts.front')
@section('content')
<div class="ayada" id="prt-content">
      <div class="pic-con">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
      </div>
      <div class="pic-con2">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
      </div>
      <div class="pic-con3">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
      </div>
      <div class="pic-con4">
        <img src="{{asset('img/pic.png')}}" class="pic1" alt="">
        <img src="{{asset('img/pic.png')}}" class="pi2" alt="">
      </div>
      <div class="page">
        <header>
            <img src="{{asset('img/logo.png')}}" alt="">
        </header>
        <div class="container">
          <div class="content">
            <div class="text">
              <p>عيادة الحيونات </p>
              <h3>{{__('admin.Simplified tax invoice')}}</h3>
            </div>
            <hr>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>
                      اسم العميل
                    </th>
                    <th>
                    {{__('admin.Pet name')}}
                    </th>
                    <th>
                      رقم الملف
                    </th>
                    <th>
                      الطبيب المعالج
                    </th>
                    <th>
                      {{__('admin.address')}}
                    </th>
                    <th>
                    {{__('admin.Mobile_number')}}
                    </th>
                    <th>
                      الرقم الضرريبي
                    </th>
                    <th>
                    {{__('admin.Date')}}
                    </th>
                    <th>
                    {{__("admin.time")}}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      حافظ الحميد
                    </td>
                    <td>
                      حيوان 2
                    </td>
                    <td>
                      1
                    </td>
                    <td>
                      دكتور 1
                    </td>
                    <td>
                      حي طويق
                    </td>
                    <td>
                      0506499275
                    </td>
                    <td>
                      310954677800003
                    </td>
                    <td>
                      2023-07-25
                    </td>
                    <td>
                      01:34 PM
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>
                    {{__('admin.Type')}}
                    </th>
                    <th>
                      {{__('number')}}
                    </th>
                    <th>
                      الخصم
                    </th>
                    <th>
                      المجموع قبل الخصم والضريبة
                    </th>
                    <th>
                      {{__('admin.Total')}}
                    </th>
                    <th>
                      ضريبة القيمة المضافة
                    </th>
                    <th>
                      المجموع شامل الصريبة
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      خدمة 1
                    </td>
                    <td>
                      1
                    </td>
                    <td>
                      0
                    </td>
                    <td>
                      0
                    </td>
                    <td>
                      100
                    </td>
                    <td>
                      0
                    </td>
                    <td>
                      100
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="table-container">
              <table>
                <tbody>
                  <tr>
                    <td>
                      فاتورة ل
                    </td>
                    <td>
                      المبلغ الاجمالي
                    </td>
                    <td>
                      100{{ __('admin.R.S') }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      {{__('admin.Client')}}
                    </td>
                    <td>
                      {{__('admin.tax')}} (15%)
                    </td>
                    <td>
                      15{{ __('admin.R.S') }}
                    </td>
                  </tr>
                  <tr>
                    <td>
                      رقم العميل
                    </td>
                    <td>
                      المبلغ المستحق
                    </td>
                    <td>
                      115{{ __('admin.R.S') }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="d-flex mt-3 justify-content-center not-print">
              <button class="btn btn-sm btn-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                        <span>{{ __('admin.print') }}</span>
                    </button>
          </div>
        </div>
        <footer>
        </footer>
</div>
</div>

@endsection

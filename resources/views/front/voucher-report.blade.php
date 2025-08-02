@extends('front.layouts.front')
@section('title')
{{ __('Account statement') }}
@endsection
@section('content')
<section class="main-section account-statement">
  <div class="container">
    <h4 class="main-heading-bg mb-3">تقرير القيود</h4>
    <div class="bar-info mb-4">
      <div class="bar">
        <div class="info">
          <h6 class="key">رقم القيد</h6>
          <p class="value">2023</p>
        </div>
        <div class="info">
          <h6 class="key">تاريخ القيد</h6>
          <p class="value">2023-09-27</p>
        </div>
        <div class="info">
          <h6 class="key">اسم القيد</h6>
          <p class="value">تنلي</p>
        </div>
      </div>
      <div class="bar">
        <div class="info">
          <h6 class="key">رقم المستند</h6>
          <p class="value">2023-09-27</p>
        </div>
        <div class="info">
          <h6 class="key">فئة القيد</h6>
          <p class="value">قيد جدوي</p>
        </div>
        <div class="info">
          <h6 class="key bg-transparent"></h6>
          <p class="value"></p>
        </div>
      </div>
      <div class="bar">
        <div class="info">
          <h6 class="key">المسلسل النظامي</h6>
          <p class="value">654</p>
        </div>
        <div class="info">
          <h6 class="key">رمز المستند</h6>
          <p class="value">mnwlad</p>
        </div>
        <div class="info">
          <h6 class="key">تاريخ الترحيل</h6>
          <p class="value">2023-09-27</p>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table main-table">
        <thead>
          <tr>
            <th>
              {{ __('debtor') }}
            </th>
            <th>
              {{ __('creditor') }}
            </th>
            <th>{{ __('Account number') }}</th>
            <th>{{ __('Account name') }}</th>
            <th>{{ __('Statement') }}</th>
            <th>مركز التكلفة</th>
            <th>{{ __('Seller') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              5
            </td>
            <td>
              5
            </td>
            <td>20230</td>
            <td>فهد مفرع</td>
            <td>
              حوالة صادرة الي جاري بنك التسويق
              <br>
              بتاريخ 2023-09-27
            </td>
            <td>فرع سكاكا</td>
            <td>محمود البدري</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>545453</td>
            <td>545453</td>
            <td colspan="8">الإجمالي</td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="holder d-flex align-items-center justify-content-between">
        <div class="text-center">
            اعداد
            <br>
            .....................
        </div>
        <div class="text-center">
            مراجعة
            <br>
            .....................
        </div>
    </div>
  </div>
</section>
@endsection

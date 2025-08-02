@extends('front.layouts.front')
@section('title')
سند فاتورة
@endsection
@push('css')

@endpush
@section('content')
<section class='main-section'>
  <div class="container">
    <div class="main-content">
      <div class="box">
        <div class="header">
          <div class="logo">
            <img src="{{ display_file(setting()->logo) }}" alt="">
          </div>
          <h3>{{ setting()->site_name }}</h3>
          <p>
            سند الفاتورة - {{$invoice->invoice_number}}
          </p>
        </div>
        <div class="content row gx-3 gy-2 my-2">
          <div class="col-12 col-md-6 col-lg-4">
            <p>
              {{__('admin.address')}}:
              <span>
                {{ setting()->address }}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
            {{__('admin.Mobile_number')}}:
              <span>
                {{ setting()->phone }}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
              الرقم الضرريبي:
              <span>
                {{ setting()->tax_no }}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
             {{$invoice->created_at->format('Y-m-d')}}
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
              اسم العميل:
              <span>
                {{$invoice->patient->name}}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
              رقم الملف:
              <span>
                {{$invoice->id}}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
              الطبيب المعالج:
              <span>
                {{$invoice->dr->name }}
              </span>
            </p>
          </div>
          <div class="col-12 col-md-6 col-lg-4">
            <p>
            {{__('admin.Employee')}} :
              <span>
                {{$invoice->employee->name }}
              </span>
            </p>
          </div>
        </div>
        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>
                  <strong>
                    المبلغ
                  </strong>
                  <br>
                  <strong>
                    Amount
                  </strong>
                </th>
                <th>
                  <strong>
                    طريقة الدفع
                  </strong>
                  <br>
                  <strong>
                    Payment Method
                  </strong>
                </th>
                <th>
                  <strong>
                    {{__('admin.Status')}}
                  </strong>
                  <br>
                  <strong>
                    Status
                  </strong>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{$invoice->amount}}</td>
                @if($invoice->cash)
                <td>{{__('admin.Cash')}}</td>
                @elseif($invoice->card)
                <td>كارد</td>
                @elseif($invoice->rest)
                <td>جزئي</td>
                @elseif($invoice->visa)
                <td>بالفيزا</td>
                @elseif($invoice->mastercard)
                <td>بالمستر كارد</td>
                @endif
                <td>{{$invoice->status}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="foot-text d-flex flex-column align-items-center my-3">
          <p>
            شكرا لزيارتكم
          </p>
          <div class="qr">
            <img class=""
              src="https://static.vecteezy.com/system/resources/previews/002/557/391/original/qr-code-for-scanning-free-vector.jpg"
              alt="">
          </div>
        </div>
      </div>
      <div class="btn-print d-flex justify-content-center">
        <a class="print not-print btn btn-sm btn-info px-4 mt-3" href="javascript:print()">{{ __('print')}}</a>
      </div>
    </div>
  </div>
</section>
@endsection

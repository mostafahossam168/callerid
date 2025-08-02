@extends('front.layouts.front')
@section('title')
    سندات القيد
@endsection
@section('content')
    @php
        $receiptVouchers = App\Models\ReceiptVoucher::all();
        $paymentVouchers = App\Models\PaymentVoucher::all();
        $allVouchers = App\Models\ReceiptVoucher::all()->merge(App\Models\PaymentVoucher::all());

        if (request()->type = 'paymentVouchers') {
            $vouchers = $paymentVouchers;
        } elseif (request()->type = 'receiptVouchers') {
            $vouchers = $receiptVouchers;
        } else {
            $vouchers = $allVouchers;
        }
    @endphp

    <form class="d-flex align-items-center gap-2">
        <select name="type" class="form-control " id="">
            <option value="all">الكل</option>
            <option value="paymentVouchers">صرف</option>
            <option value="receiptVouchers">قبض</option>
        </select>
        <input type="submit" value="أختر" class="btn btn-primary btn-sm h-100 w-auto ">
    </form>

    <div>
        <div class="table-responsive">
            <table class="table main-table">
                <thead class="">
                    <tr>
                        <th># </th>
                        <th>العنوان</th>
                        <th>النوع</th>
                        <th>المبلغ</th>
                        <!-- <th>{{ __('debtor') }}</th> -->
                        <!-- <th>الحركه الماليه </th> -->
                        <th>التحكم </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $voucher)
                        <tr>
                            <td>{{ $voucher->id }}</td>
                            <td>{{ $voucher->title }}</td>
                            <td>{{ $voucher->getTable() == 'payment_vouchers' ? 'سند صرف' : 'سند قبض' }}</td>
                            <td>{{ $voucher->amount }}</td>
                            <!-- <td>{{ $voucher->debit }}</td> -->
                            <!-- <td>ارباح 200  </td> -->
                            <td>
                                <a href="{{ route('front.' . ($voucher->getTable() == 'payment_vouchers' ? 'payment-vouchers' : 'receipt-vouchers') . '.edit', $voucher->id) }}"
                                    class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete"><i></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">حذف أصل </h5>
                                        <button type="button" class="btn-close ms-0 me-auto" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        سيتم حذف جميع الحركات المالية المرتبطه بهذا القيد ؟
                                        هل انت متاكد
                                    </div>
                                    <div class="modal-footer">
                                        <!-- delete asset form -->
                                        <form
                                            action="{{ route('front.' . ($voucher->getTable() == 'payment_vouchers' ? 'payment-vouchers' : 'receipt-vouchers') . '.destroy', $voucher->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                data-bs-dismiss="modal">لا</button>
                                            <button class="btn btn-sm btn-primary" type="submit">نعم</button>
                                        </form>
                                    </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

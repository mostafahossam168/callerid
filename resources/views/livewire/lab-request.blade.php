{{-- <section class="main-section users">
    <x-alert></x-alert>

    <div class="container" id="data-table">
        @if ($screen == 'index')
            <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
                <h4 class="main-heading mb-0">{{ __('Lap Requests') }}</h4>
            </div>
            <div class="bg-white shadow p-4 rounded-3">
                <div
                    class="amountPatients-holder d-flex align-items-start align-items-md-center justify-content-between flex-column flex-md-row">
                    <div class="btn-holders mb-2">
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="">

                    <div class="table-responsive">
                        <table id="prt-content" class="table main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('patient') }}</th>
                                    <th>{{ __('the Doctor') }}</th>
                                    <th>{{ __('admin.Type') }}</th>
                                    @lab
                                        <th class="text-center not-print">{{ __('admin.managers') }}</th>
                                    @endlab
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>{{ $request->patient?->name }}</td>
                                        <td>{{ $request->employee?->name }}</td>
                                        <td>{{ __($request->form_type) }}</td>
                                        <td class="not-print">
                                            <a class="btn btn-sm btn-warning"
                                                href="{{ route('front.test-form', $request->id) }}">
                                                اضافة التحليل
                                            </a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $request->id }}">

                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                            <a href="{{ route('front.show-test', $request->id) }}">
                                                <i class="fa-solid fa-eye"></i>

                                            </a>
                                            @include('front.requests.delete')
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{ $requests->links() }}
                </div>
            </div>
        @else
            @include('lab.requests.show')
        @endif
    </div>
</section>
 --}}

<div class="container">
    <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
        <h4 class="main-heading mb-0">{{ __('Lab Orders') }}</h4>
    </div>

    <div class="bg-white shadow p-4 rounded-3">
        <div class="table-responsive">
            <table id="prt-content" class="table main-table">
                <thead>
                    <tr>
                        <th>رقم الفاتورة</th>
                        <th>المالك</th>
                        <th>الاليف</th>
                        <th>الطبيب</th>
                        <th>تاريخ الطلب</th>
                        <th>الفني</th>
                        <th>حالة الطلب</th>
                        <th>التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->patient?->name }}</td>
                            <td>{{ $invoice->animal?->name }}</td>
                            <td>{{ $invoice->dr?->name }}</td>
                            <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                            <td>{{ $invoice->lab_user?->name }}</td>
                            <td>{{ __($invoice->status) }}</td>
                            <td class="not-print">
                                <button type="button" wire:click="getItem({{ $invoice->id }})"
                                    class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#show">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="modal fade" id="show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
                wire:ignore.self>
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">عرض المختبر</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <div class="table-responsive ">
                                    <table class="table main-table">
                                        <thead>
                                            <tr>
                                                <th>العيادة</th>
                                                <th>منتج</th>
                                                <th>@lang('Current quantity')</th>
                                                <th>السعر</th>
                                                <th>قيمة الضريبة</th>
                                                <th>الإجمالي</th>
                                                <th>إجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($invoice_data)

                                                @foreach ($invoice_data->items as $invoice_item)
                                                    <tr>
                                                        <td>{{ $invoice_item->department }}</td>
                                                        <td>{{ $invoice_item->product_name }}</td>
                                                        <td>{{ $invoice_item->quantity }}</td>
                                                        <td>{{ $invoice_item->price }}</td>
                                                        <td>{{ $invoice_item->tax }}</td>
                                                        <td>{{ $invoice_item->sub_total }}</td>
                                                        <td>
                                                            @if ($invoice_item->analysis)
                                                                <a class="btn btn-sm btn-success"
                                                                    href="{{ route('lab.analysis.show', $invoice_item->analysis->id) }}">عرض
                                                                    النتائج</a>
                                                            @endif
                                                            <a class="btn btn-sm btn-primary"
                                                                href="{{ route('lab.analysis.create', $invoice_item) }}">
                                                                @if ($invoice_item->analysis)
                                                                    تعديل
                                                                @else
                                                                    كتابة
                                                                @endif
                                                                نتائج التحليل
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">رجوع</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

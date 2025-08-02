<div class="container">
    <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
        <h4 class="main-heading mb-0">{{ __('Lab Orders') }}</h4>
    </div>

    <div class="d-flex align-items-center mb-3">
        <button wire:click="$set('filter','new')" type="button" class="btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            طلبات جديدة ({{ $all_invoices->whereNull('lab_user_id')->count() }})
        </button>
        <button wire:click="$set('filter','old')" type="button" class="btn btn-purple btn-sm mx-1" wire:click='export'>
            طلبات سابقة ({{ $all_invoices->whereNotNull('lab_user_id')->count() }})
        </button>
        <button wire:click="$set('filter','all')" type="button" class="btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#importModel">
            كل الطلبات ({{ $all_invoices->count() }})
        </button>
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
                                <button type="button" wire:click="getItem({{ $invoice->id }})" class="btn btn-primary btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#show">
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

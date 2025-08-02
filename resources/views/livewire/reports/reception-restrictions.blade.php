<section class="main-section">
    <div class="container">
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap  mb-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                        <i class="fas fa-angle-right"></i>
                    </a>
                    <h4 class="main-heading mb-0">{{ __('Daily reception restrictions') }}</h4>
                </div>
                <div class="btn-holder d-flex align-items-center gap-1">
                    <a href="{{ route('front.vouchers.index') }}" class="btn-main-sm">
                        القيود اليومية
                    </a>
                    <a href="{{ route('front.reception-restrictions') }}" class="btn-main-sm">
                        قيود الاستقبال
                    </a>
                    <a href="{{ route('front.accounts-tree') }}" class="btn-main-sm">
                        شجرة الحسابات
                    </a>
                </div>
            </div>
            <div class="d-flex align-items-end justify-content-between flex-wrap gap-2 mb-2">
                <div class="row flex-grow-1 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 row-cols-xxl-6 g-3">
                    <div class="col">
                        <div class="inp-holder">
                            <label class="small-label">بحث برقم القيد</label>
                            <input type="text" wire:model='search' class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="inp-holder">
                            <label class="small-label">من</label>
                            <input type="date" wire:model='from' id="" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="inp-holder">
                            <label class="small-label">الي</label>
                            <input type="date" wire:model='to' id="" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-1">
                    @if($reviews->count())
                    <button type="button" wire:click='export' class="btn btn-info btn-sm">تصدير Excel</button>
                    @endif
                    <button class="btn btn-sm btn-warning " id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                </div>
            </div>
            <div id="prt-content">
                {{-- <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>رقم القيد</th>
                                <th>رقم الفاتورة</th>
                                <th>حالة الفاتورة</th>
                                <th>خدمة الفاتورة</th>
                                <th>تاريخ القيد</th>
                                <th>الحساب</th>
                                <th>مدين</th>
                                <th>دائن</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($reviews as $voucher)
                            <tr>
                                <th style="background-color: #eeeeee;" colspan="12">
                                    قيد رقم {{ $voucher->id }}
                </th>
                </tr>
                @foreach($voucher->accounts as $review)
                <tr>
                    @if(!$loop->index)
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->invoice_id }}</td>
                    <td> {{ __($review->invoice?->status) }} </td>
                    <td>{{$review->description}}</td>
                    @else
                    <td colspan="4"></td>
                    @endif
                    <td>{{ $review->parent_date }}</td>
                    <td>{{ $review->account?->name }}</td>
                    <td>{{ $review->debit ?? 0 }}</td>
                    <td>{{ $review->credit ?? 0 }}</td>
                </tr>
                @endforeach
                @endforeach
                </tr>
                <tfoot>
                    <tr>
                        <th colspan="6" class="text-center">{{ __('Total') }}</th>
                        <td>{{ $reviews->sum('credit') }}</td>
                        <td>{{ $reviews->sum('debit') }}</td>
                    </tr>
                </tfoot>
                </tbody>
                </table>
            </div> --}}
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th>#</th>
                            {{-- <th>الأسم</th> --}}
                            {{-- <th>{{ __('debtor') }}</th> --}}
                            {{-- <th>{{ __('creditor') }}</th> --}}
                            <th>التاريخ</th>
                            {{-- <th>الموظف</th>  --}}
                            <th class="not-print">العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $voucher)
                        <tr>
                            <td>{{ $voucher->id }}</td>
                            {{-- <td>{{ $voucher->description }}</td> --}}
                            {{-- <td>{{ $voucher->debit }}</td> --}}
                            {{-- <td>{{ $voucher->credit }}</td> --}}
                            <td>{{ $voucher->date }}</td>
                            {{-- <td>{{ $voucher->employee?->name }}</td> --}}
                            <td class="not-print">
                                <a href="{{ route('front.vouchers.show', $voucher) }}" class="btn btn-sm btn-purple"><i></i>
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('front.vouchers.edit', $voucher) }}" class="btn btn-sm btn-info"><i></i>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                @can('delete_accounting_tree_and_daily_entries')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $voucher->id }}"><i></i>
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                @include('livewire.voucher.delete')
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            {{ $reviews->links() }}
        </div>
    </div>
    </div>
</section>
<section class="main-section">

    <div class="container">
        <div class="p-3 shadow rounded-3 bg-white">
            <div class="d-flex align-items-center gap-3 mb-3">
                <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
                <h4 class="main-heading mb-0">
                    @lang('Trial Balance') الحسابات
                </h4>
            </div>
            <x-message-admin />
            <div class="alert alert-info fs-13px mb-2" role="alert">
                يجب ربط الفواتير بأحد الحسابات بالذهاب مباشرة لـ اعدادت الحسابات <a class=" text-decoration-underline " href="{{ route('front.accounting-department') }}">هنا</a>
            </div>
            <div class="d-flex align-items-end justify-content-between mb-2">
                <div class="d-flex gap-2">
                    <div class="box-info">
                        <label for="duration-from" class="small-label">{{ __('Year') }}</label>
                        <select wire:model='date' id="date" class="main-select w-100">
                            @for($i = 0; $i < 15; $i++) @php $current=Carbon\Carbon::now()->subYears(5)->format('Y') + $i;
                                @endphp
                                <option value="{{ $current }}">
                                    {{ $current }}
                                </option>
                                @endfor
                        </select>
                    </div>
                    <div class="box-info">
                        <label for="duration-to" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from" id="duration-to" />
                    </div>
                    <div class="box-info">
                        <label for="duration-to" class="small-label">{{ __('admin.to') }}</label>
                        <input type="date" class="form-control" wire:model="to" id="duration-to" />
                    </div>
                </div>
                <div class="d-flex gap-2">
                    @if($allReviews)
                    <button class="btn btn-sm btn-warning" id="btn-prt-content">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-info" id="export-btn" wire:click="export">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>{{ __('admin.Export') }} Excel</span>
                    </button>
                    @endif
                    <button class="btn btn-danger btn-sm" wire:click='resetFromTo'>{{ __('Reset') }}</button>
                    @if($transfers)
                    <button class="btn btn-dark btn-sm" wire:click='bulkTransfer'>ترحيل</button>
                    @endif
                </div>
            </div>
            @if($reviews->count())
            <div class="table-responsive" id="prt-content">
                <table class="table main-table" dir="rtl">
                    <thead>
                        <tr>
                            <th rowspan="2" class="border pb-4 not-print">تحديد <button class="bg-transparent" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ __('This option is intended for transferring balances to the new year') }}"><i class="fas fa-circle-question"></i></button></th>
                            <th rowspan="2" class="border pb-4">رقم الحساب</th>
                            <th rowspan="2" class="border pb-4">الاسم</th>
                            <th colspan="2" class="border">الرصيد الافتتاحي</th>
                            <th colspan="2" class="border">الحركة السنوية</th>
                            <th colspan="2" class="border">رصيد الاغلاق</th>
                            <th rowspan="2" class="border pb-4">الرصيد</th>
                            <th rowspan="2" class="border pb-4 not-print">العمليات</th>
                        </tr>
                        <tr>
                            <th class="border">
                                مدين
                            </th>
                            <th class="border">
                                دائن
                            </th>
                            <th class="border">
                                مدين
                            </th>
                            <th class="border">
                                دائن
                            </th>
                            <th class="border">
                                مدين
                            </th>
                            <th class="border">
                                دائن
                            </th>
                        </tr>
                    </thead>
                    {{-- @dump($reviews)  --}}
                    <tbody>
                        @foreach ($reviews as $review)
                        {{-- @dump($review->parentCalculates())  --}}
                        @php
                        $debit = $review->account->vouchersAccounts()->whereBetween('parent_date',[$from ? $from : Carbon::parse("$date-01-01")->firstOfYear(),$to ? $to : Carbon::parse("$date-01-01")->endOfYear()])->sum('debit');
                        $credit = $review->account->vouchersAccounts()->whereBetween('parent_date',[$from ? $from : Carbon::parse("$date-01-01")->firstOfYear(), $to ? $to : Carbon::parse("$date-01-01")->endOfYear()])->sum('credit');
                        $balance = ($review->debit_opening_balance + $debit) - ($review->opening_credit_balance + $credit);
                        // totals
                        $totalDebit += $debit;
                        $totalCredit += $credit;
                        $totalBalance += (int) $balance;
                        $totalClosedDebit += $review->debit_opening_balance + $debit;
                        $totalClosedCredit += $review->opening_credit_balance + $credit;
                        @endphp
                        <tr>
                            <td class="not-print">
                                <input type="checkbox" wire:model="transfers.{{ $review->id }}" value="{{ $balance }}">
                            </td>
                            <td class="border">{{ $review->account?->id }}</td>
                            <td class="border">{{ $review->account?->name }}</td>
                            <td class="border">{{ $review->debit_opening_balance }}</td>
                            <td class="border">{{ $review->opening_credit_balance }}</td>
                            <td class="border">{{ $debit }}</td>
                            <td class="border">{{ $credit }}</td>
                            <td class="border">{{ $review->debit_opening_balance + $debit }}</td>
                            <td class="border">{{ $review->opening_credit_balance + $credit }}</td>
                            <td class="border">{{ $balance >= 0 ? $balance : '(' . ($balance - ($balance * 2)) . ')' }}</td>
                            <td class="not-print">
                                <a href="" class="btn btn-sm btn-info not-print" data-bs-toggle="modal" data-bs-target="#delete_agent" wire:click='edit({{ $review->id }})'><i></i>
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                {{-- <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#transfer{{ $review->id }}"><i></i>
                                <i class="fa-solid fa-arrow-left"></i>
                                </a>
                                <div class="modal fade" id="transfer{{ $review->id }}" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true" wire:ignore>
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                ترحيل الي سنة {{ $date + 1 }}
                                            </div>

                                            <div class="modal-body">
                                                <p>الرصيد المرحل</p>
                                                <h4>{{ $balance > 0 ? $balance : '(' . ($balance - ($balance * 2)) . ')' }}</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">لا</button>
                                                <button class="btn btn-sm  btn-danger" type="button" wire:click='transfer({{ $review->id }},{{ $balance }})' data-bs-dismiss="modal">نعم</button>
                                            </div>

                                        </div>

                                    </div>
                                </div> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <footer>
                        <thead>
                            <tr>
                                <th rowspan="2" class="border pb-4 not-print"></th>
                                <th rowspan="2" class="border pb-4"></th>
                                <th rowspan="2" class="border pb-4"></th>
                                <th colspan="2" class="border">الرصيد الافتتاحي</th>
                                <th colspan="2" class="border">الحركة السنوية</th>
                                <th colspan="2" class="border">رصيد الاغلاق</th>
                                <th rowspan="2" class="border pb-4">الرصيد</th>
                                <th rowspan="2" class="border pb-4 not-print"></th>
                            </tr>
                            <tr>
                                <th class="border">
                                    مدين
                                </th>
                                <th class="border">
                                    دائن
                                </th>
                                <th class="border">
                                    مدين
                                </th>
                                <th class="border">
                                    دائن
                                </th>
                                <th class="border">
                                    مدين
                                </th>
                                <th class="border">
                                    دائن
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border not-print">--</td>
                                <td colspan="2" class="border">{{ __('Total') }}</td>
                                <td class="border">{{ $reviews->sum('debit_opening_balance') }}</td>
                                <td class="border">{{ $reviews->sum('opening_credit_balance') }}</td>
                                <td class="border">{{ $totalDebit }}</td>
                                <td class="border">{{ $totalCredit }}</td>

                                <td class="border">{{ $totalClosedDebit }}</td>
                                <td class="border">{{ $totalClosedCredit }}</td>

                                <td class="border">{{ $totalBalance > 0 ? $totalBalance : '(' . ($totalBalance - ($totalBalance * 2)) . ')' }}</td>
                                <td class="not-print">

                                </td>
                            </tr>
                        </tbody>
                    </footer>
                </table>
            </div>
            @else
            <div class="alert alert-warning d-flex justify-content-center align-items-center text-center">
                <button wire:click='addYearReview' class="btn-main-sm">
                    <i class="fas fa-plus"></i> اضافة حساب مراجعة
                </button>
                <span class=" flex-grow-1 ">لا يوجد ميزان مراجعة</span>
            </div>
            @endif
            <div class="modal fade" id="delete_agent" tabindex="-1" aria-labelledby="exampleModallabel" aria-hidden="true" wire:ignore>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            تعديل الرصيد الإفتتاحي
                        </div>

                        <div class="modal-body">
                            <div class="form-group d-flex gap-1">
                                <label for="">الرصيد المدين</label>
                                <input type="number" class="form-control" wire:model='debit_opening_balance'>
                            </div>
                            <div class="form-group d-flex gap-1 mt-3">
                                <label for="">الرصيد الدائن</label>
                                <input type="number" class="form-control" wire:model='opening_credit_balance'>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">لا</button>
                            <button class="btn btn-sm  btn-danger" type="button" wire:click='submitReview' data-bs-dismiss="modal">نعم</button>
                        </div>

                    </div>

                </div>
            </div>

            <!-- end table-responsive -->
        </div>
    </div>
</section>
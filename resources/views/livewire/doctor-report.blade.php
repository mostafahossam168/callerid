<section class="bills-section dr-main-section">
    <div class="container">
        <div class="bills-content bg-white px-4 py-3 rounded-3 shadow">
            <div class="status-info d-flex flex-wrap align-items-center justify-content-center gap-2 mb-3">
                <div class="info-data">نوع النسبه :
                    @if (doctor()->rate_type == 'without_rate')
                        راتب بدون نسبه
                    @elseif(doctor()->rate_type == 'rating_after_salary')
                        نسبه بعد الراتب
                    @elseif(doctor()->rate_type == 'rating_starting_salary')
                        النسبه من البدايه
                    @endif
                </div>
                <div class="info-data">{{ __('admin.rate') }} : {{ doctor()->rate }} </div>
                <div class="info-data">الراتب الاساسي : {{ doctor()->salary }} </div>
                <div class="info-data">الراتب مع النسبه :
                    @if (doctor()->rate_type == 'without_rate')
                        {{ doctor()->salary }}
                    @elseif(doctor()->rate_type == 'rating_after_salary')
                        @if ($invoices->where('status', 'Paid')->sum('total') >= doctor()->salary)
                            {{ doctor()->salary + $rate }}
                        @else
                            {{ doctor()->salary }}
                        @endif
                    @elseif(doctor()->rate_type == 'rating_starting_salary')
                        {{ doctor()->salary + $rate }}
                    @endif
                </div>
            </div>
            <div class="row mb-3 g-3">
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="duration-from" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" value="2022-07-12" wire:model="from"
                            id="duration-from" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="duration-to" class="small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" value="2024-03-03" wire:model="to"
                            id="duration-to" />
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label for="bill-state" class="small-label">{{ __('admin.Status') }}</label>
                        <select class="main-select w-100 bill-state" id="bill-state" wire:model="status">
                            <option value="">{{ __('admin.All') }}</option>
                            <option value="paid">{{ __('admin.Paid') }}</option>
                            <option value="unpaid">{{ __('admin.Unpaid') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-flex align-items-end">
                    <div class="inp-holder w-100 d-flex justify-content-end gap-1">
                        <button class="btn btn-sm btn-warning rounded-0" id="btn-prt-content">
                            <i class="fa-solid fa-print"></i>
                        </button>
                        <button type="button" wire:click="resetForm" class="sec-btn-gre px-4">
                            {{ __('admin.Reset') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-print" id="prt-content">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                <th>{{ __('admin.Invoice no.') }}</th>
                                <th>{{ __('admin.patient') }}</th>
                                <th>{{ __('admin.dr') }}</th>
                                <th>{{ __('admin.employee') }}</th>
                                <th>{{ __('admin.Date') }}</th>
                                <th>{{ __('admin.Total') }}</th>
                                <th>نسبة الخدمات</th>
                                <th>{{ __('admin.Status') }}</th>
                                <th class="not-print">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                                @php
                                    $product_percent = 0;
                                @endphp
                                @foreach ($invoice->products as $product)
                                    @if (in_array(
                                            $product->product_id,
                                            doctor()->product_percents()->pluck('product_id')->toArray()))
                                        @php
                                            $product_percent +=
                                                (doctor()
                                                    ->product_percents()
                                                    ->where('product_id', $product->product_id)
                                                    ->first()->percent *
                                                    $product->sub_total) /
                                                100;
                                        @endphp
                                    @endif
                                @endforeach
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $invoice->patient->name }}</td>
                                    <td>{{ $invoice->dr->name }}</td>
                                    <td>{{ $invoice->employee->name }}</td>
                                    <td>{{ $invoice->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $invoice->total }}</td>
                                    <td>{{ $product_percent }}</td>
                                    <td>{{ __($invoice->status) }}</td>
                                    <td class="not-print">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('front.invoices.show', $invoice) }}"
                                                class="btn btn-sm btn-purple">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

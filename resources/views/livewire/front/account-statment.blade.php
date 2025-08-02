<section class="main-section">
    <div class="container">
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap  mb-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                        <i class="fas fa-angle-right"></i>
                    </a>
                    <h4 class="main-heading m-0">{{ __('Account statement') }}</h4>
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

            <div class="btn-holder d-flex align-items-center justify-content-end gap-1 mb-1">
                @if ($vouchers)
                    <button class="btn btn-sm btn-info" wire:click="export">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>تصدير Excel</span>
                    </button>
                @endif
                <button class="btn btn-sm btn-warning " id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
            <div class="row g-3 mb-2">
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account name') }}</label>
                        <select wire:model='filter_account' class="main-select w-100">
                            <option value="">{{ __('Account name') }}</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account number') }}</label>
                        <input type="number" name="" readonly value={{ $filter_account }} id=""
                            class="form-control">
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('From the date of') }}</label>
                        <input type="date" name="" id="" class="form-control"
                            wire:model='filter_start_date'>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('To date') }}</label>
                        <input type="date" name="" id="" class="form-control"
                            wire:model='filter_end_date'>
                    </div>
                </div>
            </div>
            <div id="prt-content">
                <h4 class="main-heading d-none d-block-print mb-2">{{ __('Account statement') }}</h4>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <tr>
                                {{-- <th>{{ __('Seller') }}</th> --}}
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Account') }}</th>
                                <th>{{ __('Statement') }}</th>
                                <th class="border">{{ __('debtor') }}</th>
                                <th class="border">{{ __('creditor') }}</th>
                                <th class="border"> {{ __('Balance') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            {{-- @if ($vouchers)
                                @php
                                    $review = App\Models\AccountReview::where('account_id', $filter_account)->first();
                                @endphp
                                <tr>
                                    <th colspan="4">الحركة المالية - الرصيد الافتتاحى</th>
                                    <td class="border">
                                        {{ $review->debit_opening_balance }}
                                    </td>
                                    <td class="border">
                                        {{ $review->opening_credit_balance }}
                                    </td>
                                    <th>
                                        --
                                    </th>
                                </tr>
                            @endif --}}
                            @php
                                $balance = 0;
                                $debitTotal = 0;
                                $creditTotal = 0;
                            @endphp
                            @foreach ($vouchers as $item)
                                @php
                                    $balance += $item->debit - $item->credit;
                                    $debitTotal += $item->debit;
                                    $creditTotal += $item->credit;
                                @endphp
                                <tr>
                                    <td>{{ $item->voucher?->date ?? '--' }}</td>
                                    <td>{{ $item->account?->name ?? '--' }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>{{ $item->debit }}</td>
                                    <td>{{ $item->credit }}</td>
                                    <th>{{ $balance }}</th>
                                </tr>
                            @endforeach
                            @if (count($vouchers))
                                <tr>
                                    <th colspan="3" class="text-center">الاجمالي</th>
                                    <td>{{ $vouchers->sum('debit') }}</td>
                                    <td>{{ $vouchers->sum('credit') }}</td>
                                    <td>{{ $vouchers->sum('debit') - $vouchers->sum('credit') }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@push('js')
    {{-- <x:pharaonic-select2::scripts /> --}}
    <script>
        document.addEventListener('livewire:load', function() {
            $('select[data-pharaonic="select2"]').select2({
                placeholder: "@lang('Select an option')",
            });
        });
    </script>
@endpush

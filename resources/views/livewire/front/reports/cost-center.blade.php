<section class="main-section">
    <div class="container">
        <div class="bg-white p-3 rounded-2 shadow">
            <div class="d-flex mb-3">
                <a href="{{ route('front.accounting') }}" class="btn bg-main-color text-white">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <h4 class="main-heading">{{ __('Cost center') }}</h4>
            <div class="btn-holder d-flex align-items-center justify-content-end mb-2">
                <button class="btn btn-sm btn-outline-info" wire:click='export'>
                    <i class="fa-solid fa-file-excel"></i>
                    <span>{{ __('admin.Export') }} Excel</span>
                </button>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Choose Branch') }}</label>
                        <select wire:model='filter_branch' id="" class="main-select w-100">
                            <option value="">{{ __('Choose Branch') }}</option>
                            @foreach ($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account') }}</label>
                        <select wire:model='filter_account' id="" class="main-select w-100">
                            <option value="">{{ __('Account') }}</option>
                            @foreach ($all_accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-12 col-md-3">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account number') }}</label>
                <input type="number" name="" readonly value={{ $filter_account }} id="" class="form-control">
            </div>
        </div> --}}

        {{-- <div class="col-12 col-md-4">
                    <div class="inp-holder">
                        <label class="small-label">{{ __('Account name') }}</label>
        <input type="text" name="" id="" class="form-control">
    </div>
    </div> --}}
    <div class="col-12 col-md-3">
        <div class="inp-holder">
            <label class="small-label">{{ __('From the date of') }}</label>
            <input type="date" name="" id="" class="form-control" wire:model='filter_start_date'>
        </div>
    </div>
    <div class="col-12 col-md-3">
        <div class="inp-holder">
            <label class="small-label">{{ __('To date') }}</label>
            <input type="date" name="" id="" class="form-control" wire:model='filter_end_date'>
        </div>
    </div>

    {{-- <div class="col-12 col-md-4">
            <div class="inp-holder">
                <label class="small-label">{{ __('Previous balance') }}</label>
    <input type="number" name="" id="" class="form-control">
    </div>
    </div> --}}
    {{-- <div class="col-12 col-md-4">
            <div class="inp-holder">
                <label class="small-label">{{ __('Seller') }}</label>
    <input type="text" name="" id="" class="form-control">
    </div>
    </div> --}}
    </div>
    <div class="table-responsive">
        <table class="table main-table">
            <thead>
                <tr>
                    {{-- <th>{{ __('Seller') }}</th> --}}
                    {{-- <th>{{ __('Date') }}</th> --}}
                    <th>{{ __('Account') }}</th>
                    {{-- <th>{{ __('Branch') }}</th> --}}
                    {{-- <th>{{ __('Statement') }}</th> --}}
                    <th>
                        {{ __('debtor') }}
                    </th>
                    <th>
                        {{ __('creditor') }}
                    </th>
                    <th>{{ __('Balance') }}</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($vouchers as $item)
                @php
                $debit = $item->debit;
                $credit = $item->credit;
                @endphp
                <tr>
                    <td>{{ $item->voucher?->date ?? '--' }}</td>
                <td>{{ $item->account?->name ?? '--' }}</td>
                <td>{{ $item->branch?->name ?? '--' }}</td>
                <td>
                    {{ $item->description }}
                </td>
                <td>
                    {{ $debit }}
                </td>
                <td>
                    {{ $credit  }}

                </td>
                <td>
                    {{ $debit - $credit }}
                </td>
                </tr>
                @endforeach
                @if(count($vouchers))
                <tr>
                    <td colspan="3"></td>
                    <td class="text-left">الاجمالي</td>
                    <td>{{ $vouchers->sum('debit') }}</td>
                    <td>{{ $vouchers->sum('credit') }}</td>
                    <td>{{ $vouchers->sum('debit') - $vouchers->sum('credit')  }}</td>
                </tr>
                @endif --}}
                @php
                $totalDebit = 0;
                $totalCredit = 0;
                @endphp
                @foreach ($accounts as $account)
                @php
                $debit = $account->vouchersAccounts()->where(function($q) use ($filter_branch,$filter_start_date,$filter_end_date){
                if($filter_branch){ $q->where('branch_id',$filter_branch); }
                if ($filter_start_date && $filter_end_date) {
                $q->whereBetween('parent_date', [$filter_start_date, $filter_end_date]);
                } elseif ($filter_start_date) {
                $q->where('parent_date', '>', $filter_start_date);
                }
                })->sum('debit');
                $credit = $account->vouchersAccounts()->where(function($q) use ($filter_branch,$filter_start_date,$filter_end_date){
                if($filter_branch){ $q->where('branch_id',$filter_branch); }
                if ($filter_start_date && $filter_end_date) {
                $q->whereBetween('parent_date', [$filter_start_date, $filter_end_date]);
                } elseif ($filter_start_date) {
                $q->where('parent_date', '>', $filter_start_date);
                }
                })->sum('credit');
                $totalDebit += $debit;
                $totalCredit += $credit;
                @endphp
                <tr>
                    <td>{{ $account->name }}</td>
                    <td>{{ $debit }}</td>
                    <td>{{ $credit }}</td>
                    <td>{{ $debit - $credit }}</td>
                </tr>
                @endforeach
                @if(count($accounts))
                <tr>
                    <th class="text-left">الاجمالي</th>
                    <td>{{ $totalDebit }}</td>
                    <td>{{ $totalCredit }}</td>
                    <td>{{ $totalDebit - $totalCredit  }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    </div>
    </div>
</section>

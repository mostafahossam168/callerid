<table dir="rtl" class="table main-table">
    <thead>
        <tr>
            <th rowspan="2" class="border pb-4">الرصيد</th>
            <th colspan="2" class="border">رصيد الاغلاق</th>
            <th colspan="2" class="border">الحركة السنوية</th>
            <th colspan="2" class="border">الرصيد الافتتاحي</th>
            <th rowspan="2" class="border pb-4">الاسم</th>
            <th rowspan="2" class="border pb-4">رقم الحساب</th>
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
    @php
    $totalDebit = 0;
    $totalCredit = 0;
    $totalBalance = 0;
    $totalClosedDebit = 0;
    $totalClosedCredit = 0;
    @endphp
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
            <td class="border">{{ $balance >= 0 ? $balance : '(' . ($balance - ($balance * 2)) . ')' }}</td>
            <td class="border">{{ $review->opening_credit_balance + $credit }}</td>
            <td class="border">{{ $review->debit_opening_balance + $debit }}</td>
            <td class="border">{{ $credit }}</td>
            <td class="border">{{ $debit }}</td>
            <td class="border">{{ $review->opening_credit_balance }}</td>
            <td class="border">{{ $review->debit_opening_balance }}</td>
            <td class="border">{{ $review->account?->name }}</td>
            <td class="border">{{ $review->account?->id }}</td>
        </tr>
        @endforeach
        <tr>
            <td class="border">{{ $totalBalance > 0 ? $totalBalance : '(' . ($totalBalance - ($totalBalance * 2)) . ')' }}</td>
            <td class="border">{{ $totalClosedCredit }}</td>
            <td class="border">{{ $totalClosedDebit }}</td>
            <td class="border">{{ $totalCredit }}</td>
            <td class="border">{{ $totalDebit }}</td>
            <td class="border">{{ $reviews->sum('opening_credit_balance') }}</td>
            <td class="border">{{ $reviews->sum('debit_opening_balance') }}</td>
            <td colspan="2" class="border">{{ __('Total') }}</td>
        </tr>
    </tbody>
</table>

    <table class="table main-table">
        <thead>
        <tr>
            {{-- <th>{{ __('Seller') }}</th> --}}
            <th rowspan="2">{{ __('Date') }}</th>
            <th rowspan="2">{{ __('Account') }}</th>
            <th rowspan="2">{{ __('Branch') }}</th>
            <th rowspan="2" >{{ __('Statement') }}</th>
            <th colspan="2" class="border">الرصيد الافتتاحي</th>
            <th rowspan="2" >
                {{ __('debtor') }}
            </th>

            <th rowspan="2">
                {{ __('creditor') }}
            </th>
            <th rowspan="2">{{ __('Balance') }}</th>
        </tr>
        <tr>
            <th class="border">مدين</th>
            <th class="border">دائن</th>
        </tr>

        </thead>
        <tbody>
        @foreach ($vouchers as $item)
            @php
                $debit = $item->debit;
                $credit = $item->credit;
            @endphp
            <tr>

                {{-- <td>قيد يومية</td> --}}
                {{-- <td>{{ $item->user?->name ?? '--' }}</td> --}}
                <td>{{ $item->voucher?->date ?? '--' }}</td>
                <td>{{ $item->account?->name ?? '--' }}</td>
                <td>{{ $item->branch?->name ?? '--' }}</td>
                <td>
                    {{ $item->description }}
                </td>
                <td class="border">
                    {{ $debit }}
                </td>
                <td class="border">
                    {{ $credit  }}
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
            <tr>
                <td colspan="3"></td>
                <td class="text-left">الاجمالي</td>
                <td>{{ $vouchers->sum('debit') }}</td>
                <td>{{ $vouchers->sum('credit') }}</td>
                <td>{{ $vouchers->sum('debit') - $vouchers->sum('credit')  }}</td>
            </tr>
        </tbody>
    </table>

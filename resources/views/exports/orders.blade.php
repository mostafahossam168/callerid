<div class="table-responsive">
    <table class="table main-table mb-0" id="data-table">
        <thead>
        <tr>
            <th>{{ __('admin.invoice_number') }}</th>
            <th>{{ __('admin.Employee') }}</th>
            <th>{{ __('admin.Client') }}</th>
            <th>{{ __('admin.Products') }}</th>
            <th>{{ __('admin.amount') }}</th>
            <th>{{ __('admin.tax') }}</th>
            <th>{{ __('admin.Total') }}</th>
            <th>{{ __('admin.Discount') }}</th>
            <th>{{ __('admin.Cash') }}</th>
            <th>{{ __('admin.card') }} - {{ __('admin.Mada') }}</th>
            <th>{{ __('admin.rest') }}</th>
            <th>{{ __('admin.Status') }}</th>
            <th>{{ __('admin.Returner') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user?->name }}</td>
                <td>{{ $order->client ? $order->client->name : 'عميل نقدي' }}</td>
                <td>
                    @forelse ($order->items as $item)
                        <span>{{ $item->name }} ( {{ __('admin.number') }} :
                                            {{ $item->quantity }})</span>
                    @empty
                        --
                    @endforelse
                </td>
                <td>{{ $order->amount }}</td>
                <td>{{ $order->tax }}</td>
                <td>{{ $order->total }}</td>
                <td>{{ $order?->discount }}</td>
                <td>{{ $order->cash }}</td>
                <td>{{ $order->card }}</td>
                <td>{{ $order->rest }}</td>
                <td>{{ __($order->status) }}</td>
                <td>
                    {{ $order->refund ? $order->refund . ' - ' . ($order->refund_status == 'creditor' ? __('admin.Creditor') : __('admin.Debtor')) : '' }}
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">{{ __('admin.total') }}</td>
            <td>{{ $all_orders->sum('amount') }}</td>
            <td>{{ $all_orders->sum('tax') }}</td>
            <td>{{ $all_orders->sum('total') }}</td>
            <td>{{ $all_orders->sum('discount') }}</td>
            <td>{{ $all_orders->sum('cash') }}</td>
            <td>{{ $all_orders->sum('card') }}</td>
            <td>{{ $all_orders->sum('rest') }}</td>
            <td colspan="3"></td>
        </tr>
        </tbody>
    </table>
</div>

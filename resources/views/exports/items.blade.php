<table class="table main-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('admin.name') }}</th>
            <th scope="col">{{ __('admin.current_quantity') }}</th>
            <th scope="col">{{ __('admin.paid_quantity') }}</th>
            <th scope="col">{{ __('admin.selling_price') }}</th>
            <th scope="col">{{ __('admin.tax') }}</th>
            <th scope="col">{{ __('admin.Total') }}</th>
            <th>{{ __('admin.Activate_quantity') }}</th>
            <th>{{ __('admin.Barcode') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($items as $item)
            @php
                $paid_quantity = \App\Models\OrderItem::where('item_id', $item->id)->sum('quantity');
            @endphp
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $item->name }}</td>
                <td class="{{ $item->quantity <= 5 ? 'text-danger' : '' }}">{{ $item->quantity }}</td>
                <td>{{ $paid_quantity }}</td>
                <td>{{ $item->sale_price }}</td>
                <td>{{ $item->tax }}</td>
                <td>{{ $item->total }}</td>
                <td>{{ $item->allow_quantity ? __('admin.Activated') : __('admin.Not activated') }}</td>
                <td>{{ $item->barcode }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

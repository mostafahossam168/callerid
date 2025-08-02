<table class="table main-table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('admin.name') }}</th>
            <th scope="col">{{ __('admin.Main category') }}</th>
            <th scope="col">{{ __('admin.Subcategory') }}</th>
            <th scope="col">{{ __('admin.open_quantity') }}</th>
            <th scope="col">{{ __('admin.quantity') }}</th>
            <th scope="col">{{ __('admin.cost_price') }}</th>
            <th scope="col">{{ __('admin.selling_price') }}</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($supplies as $supply)
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $supply->name }}</td>
                <td>{{ $supply->kind?->name ?? '-' }}</td>
                <td>{{ $supply->kind->main?->name ?? '-' }}</td>
                <td>{{ $supply->open_quantity }}</td>
                <td>{{ $supply->quantity }}</td>
                <td>{{ $supply->purchase_price }}</td>
                <td>{{ $supply->selling_price }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

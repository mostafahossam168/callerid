<table class="table main-table mt-3" style="min-width:1000px">
    <thead>
        <tr>
            <th scope="col">{{ __('service number')}}</th>
            <th scope="col">{{ __('admin.name') }}</th>
            <th scope="col">{{ __('admin.department') }}</th>
            <th scope="col">{{ __('admin.price') }}</th>
            <th scope="col">{{ __('admin.tax') }}</th>
            <th scope="col">الإجمالي</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($products as $product)
        <tr>
            <td scope="row">{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->department->name }}</td>
            <td>{{ $product->amount }}</td>
            <td>{{ $product->tax }}</td>
            <td>{{ $product->price }}</td>
        </tr>
        @endforeach


    </tbody>
</table>

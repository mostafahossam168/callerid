<div class="modal fade" id="quantities" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.quantities') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>المستودع</th>
                        <th>الكمية</th>
                    </tr>
                    @php
                        $sum_quantity = 0;
                    @endphp
                    @foreach ($all_warehouses as $warehouse)
                    @php
                        $quantity = $item?->all_quantities()->where('warehouse_id', $warehouse->id)->where('type', 'charge')->sum('quantity') -$item?->all_quantities()->where('warehouse_id', $warehouse->id)->where('type', 'expense')->sum('quantity') -$item?->all_order_items()->where('warehouse_id', $warehouse->id)->sum('quantity'); 
                        $sum_quantity += $quantity;
                    @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $warehouse->name }}</td>
                            <td>
                                {{ $quantity }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">@lang('admin.total')</th>
                        <th>{{$sum_quantity}}</th>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='expense' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

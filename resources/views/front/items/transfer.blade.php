<div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.transfer') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">                     
                    <div class="col-sm-12">
                        <label class="small-label" for="">{{ __('admin.from_warehouse') }}</label>
                        <select wire:model="from_warehouse_id" class="form-control">
                            <option value="">اختر</option>
                            @foreach ($all_warehouses as $item_warehouse)
                                <option value="{{ $item_warehouse->id }}">{{ $item_warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label class="small-label" for="">{{ __('admin.to_warehouse') }}</label>
                        <select wire:model="to_warehouse_id" class="form-control">
                            <option value="">اختر</option>
                            @foreach ($all_warehouses as $item_warehouse)
                                <option value="{{ $item_warehouse->id }}">{{ $item_warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='transfer' class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

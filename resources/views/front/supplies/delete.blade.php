<div class="modal fade" id="delete{{ $supply->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('admin.Delete product')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            {{__('admin.Are you sure to delete the product')}} ؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='delete({{ $supply->id }})' type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">{{__('admin.Yes') }}</button>
            </div>
        </div>
    </div>
</div>

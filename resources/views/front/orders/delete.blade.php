<div class="modal fade" id="delete{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete invoice') }} ?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('admin.Are_you_sure_to_delete_an_invoice?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='delete({{ $order->id }})' type="button" class="btn btn-primary"
                    data-bs-dismiss="modal">{{ __('admin.Yes') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                @lang('Are you sure to delete?')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">@lang('back')</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='delete'>@lang('Delete')</button>
            </div>
        </div>
    </div>
</div>

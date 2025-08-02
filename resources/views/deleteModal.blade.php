
<div class="modal fade" id="delete{{$item->id}}"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">@lang('delete')</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('admin.are sure of the deleting process?')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">@lang('back')</button>
                <button type="button" wire:click="delete({{$item->id}})" data-bs-dismiss="modal" class="btn btn-primary btn-sm px-4">@lang('Yes')</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete_agent{{$offer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">



            <div class="modal-body">
                {{ __('admin.are sure of the deleting process?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                wire:click='delete({{ $offer }})'>{{ __('admin.Yes') }}</button>
            </div>

        </div>

    </div>
</div>

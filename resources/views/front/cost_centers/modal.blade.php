<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('admin.Update') : __('admin.Add') }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('admin.name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">اغلاق</button>
                <button wire:click='submit' class="btn btn-primary btn-sm"
                    data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

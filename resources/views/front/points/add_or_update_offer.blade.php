<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


                <div class="modal-body">
                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">الوصف</label>
                        <input type="text" wire:model.defer="description" id="" class="w-100 form-control">
                    </div>

                    <div class="d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">عدد النقاط</label>
                        <input type="number" wire:model.defer="points" id="" class="w-100 form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                    <button class="btn btn-sm  btn-success" data-bs-dismiss="modal" wire:click='save'>{{ __('admin.Save') }}</button>
                </div>

        </div>

    </div>
</div>

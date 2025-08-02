<div class="modal fade" id="add_or_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="inp_holder mb-3">
                    <label for="" class="small-label mb-1">الكلمات الدلالية</label>
                    <textarea wire:model="keywords" rows="5" class="w-100 form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button class="btn btn-sm  btn-success" data-bs-dismiss="modal"
                    wire:click='save'>{{ __('admin.Save') }}</button>
            </div>

        </div>

    </div>
</div>

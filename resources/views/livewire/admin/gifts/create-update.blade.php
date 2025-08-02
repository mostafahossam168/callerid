 
  <!-- Modal -->
  <div class="modal fade" id="create-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row g-3">
                <div class="col-xs-12 col-md-6 mb-3">
                    <label for="">الاسم <span class="text-red">*</span></label>
                    <input class=" form-control " type="text" placeholder="" wire:model="name" />
                </div>
            
                <div class="col-xs-12 col-md-6 mb-3">
                    <label for="">الكود <span class="text-red">*</span></label>
                    <input class=" form-control" maxlength="4" type="text" placeholder="" wire:model="code" />
                </div>
            
                <div class="col-xs-12 col-md-6 mb-3">
                    <label for="">المبلغ <span class="text-red">*</span></label>
                    <input class=" form-control" type="number" placeholder="" wire:model="amount" />
                </div>
            
                <div class="col-xs-12 col-md-6 mb-3">
                    <label for="">الحالة <span class="text-red">*</span></label>
                    <select wire:model="status" id="" class="form-select">
                        <option value="">اختر الحالة</option>
                        <option value="1">مفعل</option>
                        <option value="0">غير مفعل</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
          <button type="button" data-bs-dismiss="modal" wire:click="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
      </div>
    </div>
  </div>



<div class="d-flex align-items-center justify-content-between gap-3 mb-3">
    <div class="main-title mb-0">
        <div class="small">@lang('Home')</div>
        <div class="large">الهدايا</div>
    </div>
    <div class="d-flex gap-2">
        <button class="main-btn btn-main-color" wire:click='$set("screen","index")'>@lang('View all gifts')</button>
    </div>
</div>
<div class="row g-3">
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Name')</label>
        <input type="text" wire:model="name" class="form-control">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">السعر</label>
        <input type="number" wire:model="amount" class="form-control">
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">الكود</label>
        <input type="text" maxlength="4" wire:model="code" class="form-control">
    </div>

    <div class="col-12 col-md-4 col-lg-3">
        <label for="">@lang('Active')</label>
        <select wire:model="status" class="form-control">
            <option value="">@lang('Choose status')</option>
            <option value="1">@lang('Active')</option>
            <option value="0">غير مفعل</option>
        </select>
    </div>
    <div class="col-12 col-md-4 col-lg-3">
        <label for="">مفتوح</label>
        <select wire:model="opened" class="form-control">
            <option value="">اختر</option>
            <option value="1">نعم</option>
            <option value="0">لا</option>
        </select>
    </div>


    <div class="col-12">
        <button class="main-btn" wire:click='submit'>@lang('Save')</button>
    </div>
</div>

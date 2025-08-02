<section>
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route("admin.home") }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">اعدادات النظام</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <x-message-admin></x-message-admin>
        <div class="row">
            <div class="form-group col-sm-6 col-md-3 col-lg-2">
                <input type="checkbox" wire:model="active_water_mark">
                <label class="small-label" for="">تفعيل العلامة المائية</label>
            </div>

            <div class="form-group col-sm-6 col-md-3">
                <label class="main-lable" for="">محتوي العلامة المائية</label>
                <input type="text" wire:model="water_mark_string" placeholder="محتوي العلامة المائية" class="form-control">
            </div>
            <div class="form-group col-sm-6 col-md-3 col-lg-2">
                <input type="checkbox" wire:model="pharmacy_status">
                <label class="small-label" for="">تفعيل الصيدلية</label>
            </div>
            <div class="form-group col-sm-6 col-md-3 col-lg-2">
                <input type="checkbox" wire:model="active_mkhtbr">
                <label class="small-label" for="">تفعيل المختبر</label>
            </div>
            <div class="col-md-12">
                <button class="btn btn-primary" wire:click='submit'> حفظ</button>
            </div>
        </div>
    </div>
</section>

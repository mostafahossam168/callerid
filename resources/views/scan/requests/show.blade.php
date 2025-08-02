<section>
    <button  class="btn btn-primary" wire:click.prevent='$set("screen","index")'>عرض الطلبات</button>
    <h3>معلومات الطلب</h3>
    <div class="">
        <div class="row">
            <div class="col-md-3">{{ __('admin.Owner name')}}: {{ $selected_request->patient?->name }}</div>
            <div class="col-md-3">اسم الطبيب: {{ $selected_request->doctor?->name }}</div>
            <div class="col-md-3">اسم القسم: {{ $selected_request->clinic?->name }}</div>
            <div class="col-md-3">{{ __('admin.Product name') }}: {{ $selected_request->product?->name }}</div>
            <div class="col-md-12">كشف الطبيب: {{ $selected_request->dr_content }}</div>
        </div>
        {{-- <div class="form-gruop">
            <label for="">{{__('admin.Content')}}</label>
            <textarea wire:model.defer="scan_content" class="form-control"></textarea>
        </div> --}}
        {{-- <div class="form-gruop">
            <label for="">@lang('Image')</label>
            <input type="file" wire:model.defer="file" class="form-control">
        </div> --}}

        {{-- <button class="btn btn-sm btn-primary" wire:click='submit'>اكمال الطلب</button> --}}
    </div>
</section>

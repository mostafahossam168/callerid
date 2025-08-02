<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('admin.Update') : __('admin.Add') }}
                    {{ __('admin.product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">

                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('admin.name') }}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('admin.Enter the barcode of the product') }}</label>
                        <input class="form-control" wire:model.defer='barcode' type="text" placeholder="">
                    </div>

                    <div class="col">
                        <label class="small-label" for="">القسم</label>
                        <select wire:model="category_id" class="main-select w-100">
                            <option value="">القسم</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($allow_quantity && !$item)
                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('admin.quantity') }}</label>
                        <input class="form-control" type="number" wire:model.defer='quantity' placeholder="">
                    </div>
                    @endif

                    <div class=" col-sm-6">
                        <label class="small-label" for="">{{ __('admin.selling_price') }}</label>
                        <input class="form-control" type="text" wire:model.defer='sale_price' placeholder="">
                    </div>
                    <div class=" col-sm-6">
                        <label class="small-label" for="">التاريخ</label>
                        <input class="form-control" type="date" value="{{date('Y-m-d')}}" disabled placeholder="">
                    </div>

                    <div class="col-sm-12">
                            <label class="small-label d-block mb-0" for="">@lang('Image')</label>
                            <input type="file" wire:model="image" class='form-control'>
                    </div>
                    <div class="col-sm-12">
                        <div class="inp-holder d-flex align-items-center gap-1">
                            <label class="small-label d-block mb-0" for="">{{ __('admin.sell_with_tax') }}</label>
                            <input type="checkbox" wire:model.defer='has_tax'>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <small class="alert alert-primary p-2 mb-2  d-block" role="alert">
                            {{ __('admin.In_the_event_of_selling_in_quantity,_activation_will_be_required') }}
                        </small>
                        <div class="inp-holder d-flex align-items-center gap-1">
                            <label class="small-label d-block mb-0" for="">{{ __('admin.Activate_quantity') }}</label>
                            <input value="1" type="checkbox" wire:model='allow_quantity'>
                        </div>
                        {{-- <div class="col-sm-12">
                            <div class="inp-holder d-flex align-items-center gap-1">
                                <label class="small-label d-block mb-0" for="">نوع الضريبة</label>
                                <select wire:model.defer="tax_type" id="">
                                    <option value="">اختر نوع الضريبة</option>
                                    <option value="1">بدون</option>
                                    <option value="2">شامل الضريبة</option>
                                    {{-- <option value="3">ضريبة مضمنة</option>
                                </select>
                            </div>
                        </div>  --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">اغلاق</button>
                <button wire:click='save' class="btn btn-primary btn-sm" data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
     wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"
                    id="exampleModalLabel">{{ $name ? __('admin.Update') : __('admin.Add') }} {{__('admin.kind')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">


                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{__('admin.Main class')}}</label>
                        <select wire:model="main_cat" id="" class="main-select w-100">
                            <option value="">{{__('admin.Main class')}}</option>
                            @foreach ($main_cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="collect-box d-flex flex-column mb-2">
                        <label for="" class="small-label mb-1">{{__('admin.Sub class')}}</label>
                        <select wire:model.defer="kind_id" id="" class="main-select w-100">
                            <option value="">{{__('admin.Sub class')}}</option>
                            @foreach ($sub_cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.name')}}</label>
                        <input class="form-control" type="text" wire:model.defer='name' placeholder="">
                    </div>


                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.quantity')}} ({{__('admin.open_quantity')}}
                            )</label>
                        <input class="form-control" type="number" wire:model.defer='quantity' placeholder="">
                    </div>
                    @if($supply)
                        <div class=" col-sm-4">
                            <label class="small-label" for="">{{__('admin.open_quantity')}}</label>
                            <input class="form-control" type="number" wire:model.defer='open_quantity' placeholder="">
                        </div>
                    @endif

                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.cost_price')}}</label>
                        <input class="form-control" type="text" wire:model.defer='purchase_price' placeholder="">
                    </div>
                  {{--   <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.selling_price')}}</label>
                        <input class="form-control" type="text" wire:model.defer='selling_price' placeholder="">
                    </div> --}}

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='save' class="btn btn-primary"
                        data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

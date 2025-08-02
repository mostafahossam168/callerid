<div class="modal fade" id="quantityOut" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.Disbursement amount') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row row-gap-24">


                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.quantity')}}</label>
                        <input class="form-control" type="text" wire:model.defer='quantity' placeholder="">
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.Dr')}}</label>
                        <select wire:model.defer="doctor_id" id="" class="form-control">
                            <option value="">{{__('admin.Choose the doctor')}}</option>
                            @foreach ($doctors as $dr)
                                <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-sm-4">
                        <label class="small-label" for="">{{__('admin.the clinic')}}</label>
                        <select wire:model.defer="clinic_id" id="" class="form-control">
                            <option value="">{{__('admin.Choose Clinic')}}</option>
                            @foreach ($clinics as $clinic)
                                <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
                            @endforeach
                        </select>
                    </div>



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                <button wire:click='storeQuantity("out")' class="btn btn-primary" data-bs-dismiss="modal">{{ __('admin.save') }}</button>
            </div>
        </div>
    </div>
</div>

<section class="main-section ">
    <!-- @if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
@endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.Add medicine') }}</h4>
        <div class="section-content bg-white p-4 shadow rounded-3">
            <div class="mb-4">
                <button class="btn trans-btn btn-sm px-5"
                    wire:click='$set("screen","index")'>{{ __('admin.medicines') }}</button>
            </div>
            <div class="row">
                <div class="collect-info col-md-6">
                    <label for="" class="small-label mb-2">{{ __('admin.name_ar') }}</label>
                    <input type="text" wire:model.defer="name_ar" id="" class="form-control mb-2 mb-lg-0">
                </div>
                <div class="collect-info col-md-6">
                    <label for="" class="small-label mb-2">{{ __('admin.name_en') }}</label>
                    <input type="text" wire:model.defer="name_en" id="" class="form-control mb-2 mb-lg-0">
                </div>

                <div class="collect-info col-md-6">
                    <label for="" class="small-label mb-2">{{ __('admin.cost_price') }}</label>
                    <input type="number" wire:model.defer="cost_price" id=""
                        class="form-control mb-2 mb-lg-0">
                </div>

                <div class="collect-info col-md-6">
                    <label for="" class="small-label mb-2">{{ __('admin.selling_price') }}</label>
                    <input type="number" wire:model.defer="selling_price" id=""
                        class="form-control mb-2 mb-lg-0">
                </div>

                <div class="collect-info col-md-6">
                    <label for="" class="small-label mb-2">{{ __('admin.selling_price_with_tax') }}</label>
                    <input type="number" wire:model.defer="selling_price_with_tax" id=""
                        class="form-control mb-2 mb-lg-0">
                </div>


            </div>

            <div class="btn-holder text-center mt-2">
                <button wire:loading.remove wire:click.prevent="save" class="btn btn-success btn-sm px-5">
                    @Lang('admin.Save')
                </button>

                <button wire:loading wire:target="save" class="btn btn-success btn-sm px-5">
                    <i class="fas fa-spinner fa-spin text-2xl"></i>
                </button>

            </div>

        </div>
    </div>
</section>

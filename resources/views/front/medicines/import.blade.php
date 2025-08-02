<section class="main-section ">

    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.import_from_excel') }}</h4>
        <div class="section-content bg-white p-4 shadow rounded-3">
            <div class="mb-4">
                <button class="btn trans-btn btn-sm px-5"
                    wire:click='$set("screen","index")'>{{ __('admin.medicines') }}</button>
            </div>
            <div class="d-flex flex-column flex-xl-row gap-3">
                <div class="collect-info d-flex flex-column ms-lg-2">
                    <label for="" class="small-label mb-2">{{ __('admin.file') }}</label>
                    <input type="file" wire:model.defer="file" id="" class="form-control mb-2 mb-lg-0">
                </div>

                <div class="btn-holder d-flex align-items-end mt-2 mt-lg-0 mb-lg-1">

                    <button wire:loading.remove wire:click.prevent="import" class="btn btn-success btn-sm px-5">
                        @Lang('admin.Save')
                    </button>

                    <button wire:loading wire:target="import" class="btn btn-success btn-sm px-5">
                        <i class="fas fa-spinner fa-spin text-2xl"></i> @lang('admin.processing')
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

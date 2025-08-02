<section class="addPatient-section main-section py-5">
    <!-- @if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
@endif -->
    <x-alert></x-alert>
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h4 class="main-heading mb-0">{{ __('admin.Edit patient') }}</h4>
            <button class="btn btn-sm btn-secondary">
                @lang('back')
            </button>
        </div>

    </div>
    <div class="container pt-0 p-3 bg-white vh-min-100">
        <div class="addPatient-content p-4">
            <h4 class="section-title p-3 rounded-3 mb-4 text-center">
                {{ __('admin.Personal information about the patient') }}
            </h4>
            <div class="Patient-form-data">
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" id="Patient-name" class="form-control Patient-name"
                                    wire:model.lazy="first_name" placeholder="{{ __('admin.name') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="tel" id="Patient-phone" class="form-control Patient-phone"
                                    wire:model.lazy="phone" placeholder="{{ __('admin.phone') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" id="email" class="form-control Patient-phone"
                                    wire:model.lazy="email" placeholder="{{ __('admin.email') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <select wire:model="city_id" class="form-select" id="city_id">
                                    <option value="">اختر مدينة</option>
                                    @foreach (App\Models\City::get() as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (setting()->active_tax_info_in_patients)
                <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                    {{ __('admin.tax_information') }}
                </h4>
                <div class="Patient-form-data">
                    <div class="row g-3">
                        <div class="col-12 col-md-3">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <input type="text" id="tax_number" class="form-control Patient-name"
                                        wire:model.lazy="tax_number" placeholder="{{ __('admin.tax_number') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <input type="tel" id="address" class="form-control Patient-phone"
                                        wire:model.lazy="address" placeholder="{{ __('admin.address') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <input type="text" id="street" class="form-control Patient-phone"
                                        wire:model.lazy="street" placeholder="{{ __('admin.street') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <input type="text" id="building_number" class="form-control Patient-phone"
                                        wire:model.lazy="building_number"
                                        placeholder="{{ __('admin.building_number') }}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <input type="text" id="postal_code" class="form-control Patient-phone"
                                        wire:model.lazy="postal_code" placeholder="{{ __('admin.postal_code') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="text-center">
                <button class="send-data btn btn-primary btn-sm px-4"
                    wire:click='save'>{{ __('save the data') }}</button>
            </div>

        </div>
    </div>
</section>

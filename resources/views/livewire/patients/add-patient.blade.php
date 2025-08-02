<section class="addPatient-section py-5 main-section">
    <x-alert></x-alert>
    <div class="container">
        <div class="p-4 bg-white rounded-3 shadow">
            <div class="holder mb-3 d-flex align-items-center justify-content-between">
                <h4 class="main-heading mb-0">{{ __('admin.Add patient') }}</h4>
                <a href="./" class="btn btn-sm px-3 btn-secondary">{{ __('admin.Back') }} <i
                        class="fa-solid fa-arrow-left-long"></i></a>
            </div>
            <div class="addPatient-content p-4">
                <h4 class="section-title px-2 py-3 fs-18px rounded-3 mb-4 text-center">
                    {{ __('admin.Personal information about the patient') }}
                </h4>
                <div class="Patient-form-data">
                    <div class="row g-3">
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
                        <div class="col-12 col-md-3">
                            <input type="text" id="Patient-id" class="form-control Patient-id"
                                wire:model.defer="name" placeholder="{{ __('admin.Pet name') }}" />
                        </div>
                        <div class="col-12 col-md-3">
                            <input type="text" id="age" class="form-control Patient-id" wire:model.defer="age"
                                placeholder="{{ __('admin.Age') }}" />
                        </div>
                        <div class="col-12 col-md-3">
                            <select wire:model.live="category" id="" class="main-select w-100">
                                <option value="">اختر نوع الأليف </option>
                                @foreach (App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select wire:model="strain_id" id="" class="main-select w-100">
                                <option value="">اختر سلالة الأليف </option>
                                @foreach ($strains as $strain)
                                    <option value="{{ $strain->id }}">{{ $strain->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-3">
                            <select class="gender main-select w-100" id="gender" wire:model.defer="gender">
                                <option value="">{{ __('admin.Gender') }}</option>
                                <option value="male">{{ __('admin.male') }}</option>
                                <option value="female">{{ __('admin.female') }}</option>
                            </select>
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
                                            wire:model.lazy="postal_code"
                                            placeholder="{{ __('admin.postal_code') }}" />
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
    </div>
</section>

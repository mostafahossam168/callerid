<div class="container">
    <div class="p-4 bg-white rounded-3 shadow">
        <div class="holder mb-3 d-flex align-items-center justify-content-between">
            <h4 class="main-heading mb-0">{{ $obj ? __('Edit') : __('Add') }} @lang('admin.Analysis')</h4>
            <a wire:click="$set('screen','index')" class="btn btn-sm px-3 btn-secondary">@lang('admin.back') <i
                    class="fa-solid fa-arrow-left-long"></i></a>
        </div>
        <div class="addPatient-content p-4">
            <div class="Patient-form-data">
                <div class="row g-3">

                    <div class="col-12 col-md-4">
                        <div class="fild-control">
                            <select wire:model="strain_id" id="" class="main-select w-100">
                                <option value="">@lang('admin.Choose the breed')</option>
                                @foreach ($breeds as $breed)
                                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                                @endforeach
                                <option value="all">@lang('admin.All')</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="fild-control">
                            <select wire:model="package_id" id="" class="main-select w-100">
                                <option value="">@lang('admin.Choose the package')</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                                <option value="all">@lang('admin.All')</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="field-control" style="position: relative;">
                            <x-select2 id="patient_id" wire:model="patient_id" :url="'/select2/patients'" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="fild-control">
                            <select wire:model="animal_id" id="" class="main-select w-100">
                                <option value="">@lang('admin.Choose the animal')</option>
                                @foreach ($animals as $animal)
                                    <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="date" class="form-control Patient-name" wire:model.lazy="date" />
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-4">
                        <div class="Patient-info right-side">
                            <div class="fild-control mb-3">
                                <input type="text" class="form-control Patient-name" wire:model.lazy="lab_id"
                                    placeholder="lab id" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        @if ($selectedPackage?->is_urine_analysis)
                            <div class="container">

                                <div class="medical-result  w-sm0" id="print">
                                    <div class="box-header-invoice ">
                                        <div class="row align-items-center">
                                            <div class="col-12">
                                                <h6 class="text-center "><b> </b></h6>

                                            </div>
                                            <div class="col-md-4 ">
                                                <small class="mb-1 d-block fs-14px"><b>{{ setting()->site_name }}@lang('admin.Laboratory name')
                                                    </b>
                                                </small>
                                                <small class="mb-1 d-block fs-14px"><b> @lang('admin.E-mail')
                                                        : {{ setting()->email }}</b> </small>
                                                <small class="mb-1 d-block fs-14px"><b>@lang('admin.Tax Number')
                                                        {{ setting()->tax_no }}</b></small>
                                            </div>


                                            <div
                                                class="text-center col-md-4  d-flex align-items-center justify-content-center">
                                                <img class="img-fluid img-logo mx-auto"
                                                    src="{{ display_file(setting()->logo) }}" alt="">
                                            </div>
                                            <div class="col-md-4 ">
                                                <small class="mb-1 d-block fs-14px"><b>@lang('admin.Owner name')
                                                        {{ $selectedOwner?->name }}</b></small>
                                                <small class="mb-1 d-block fs-14px"><b>@lang('admin.Animal')
                                                        {{ $selectedAnimal?->name }}</b></small>
                                                <small class="mb-1 d-block fs-14px"><b> @lang('admin.Date')
                                                        {{ date('Y-m-d') }}</b>
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Start Content -->
                                    <div class="d-flex flex-column flex-sm-row flex-wrap" dir="ltr">
                                        <div class="w-100 border-lf">

                                            <div class="border-bt fw-bold text-center pd blue fs-16px">
                                                Urine Analysis Report
                                            </div>
                                            <div class="border-bt fw-bold pd blue d-flex align-items-center">
                                                <div
                                                    class="d-flex  align-items-center justify-content-start flex-fill text-center">
                                                    <b class="">Urine Examination:</b>
                                                </div>
                                            </div>
                                            <div
                                                class="border-bt fw-bold pd blue d-flex justify-content-around align-items-center gap-5">
                                                <span class="pe-sm-5">Physical Examination</span>
                                                <span class="ps-sm-5 ms-sm-5">Reference Range</span>
                                            </div>
                                            @foreach ($items['physical_examination'] as $key => $item)
                                                <div class="d-flex align-items-center border-bt">
                                                    <div
                                                        class="flex-fill d-flex justify-content-between text-center align-items-center pd">
                                                        <b class="w-lg"> {{ $item['name_ar'] ?? '' }}
                                                            - {{ $item['name_en'] ?? '' }}</b>
                                                        <input
                                                            wire:model="items.physical_examination.{{ $key }}.result"
                                                            class="w-sm red" />
                                                        <b class="w-lg">{{ $item['reference_range'] ?? '' }}</b>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div
                                                class="border-bt fw-bold pd blue d-flex justify-content-around align-items-center gap-5">
                                                <span class="">Chemical Examination</span>
                                                <span class=""></span>
                                                <span class=""></span>
                                            </div>
                                            @foreach ($items['chemical_examination'] as $key => $item)
                                                <div class="d-flex align-items-center border-bt">
                                                    <div
                                                        class="flex-fill d-flex justify-content-between text-center align-items-center pd">
                                                        <b class="w-lg"> {{ $item['name_ar'] ?? '' }}
                                                            - {{ $item['name_en'] ?? '' }}</b>
                                                        <input
                                                            wire:model="items.chemical_examination.{{ $key }}.result"
                                                            class="w-sm red" />
                                                        <b class="w-lg">{{ $item['reference_range'] ?? '' }}</b>
                                                    </div>
                                                </div>
                                            @endforeach


                                            <div
                                                class="border-bt fw-bold pd blue d-flex justify-content-around align-items-center gap-5">
                                                <span class="">Microscopic Examination</span>
                                                <span class=""></span>
                                                <span class=""></span>
                                            </div>
                                            @foreach ($items['microscopic_examination'] as $key => $item)
                                                <div class="d-flex align-items-center border-bt">
                                                    <div
                                                        class="flex-fill d-flex justify-content-between text-center align-items-center pd">
                                                        <b class="w-lg"> {{ $item['name_ar'] ?? '' }}
                                                            - {{ $item['name_en'] ?? '' }}</b>
                                                        <input
                                                            wire:model="items.microscopic_examination.{{ $key }}.result"
                                                            class="w-sm red" />
                                                        <b class="w-lg">{{ $item['reference_range'] ?? '' }}</b>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="border-bt fw-bold pd dark text-center">
                                                <span class="fw-bold">Doctor's signature: :
                                                    {{ auth()->user()->name }}</span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('admin.name')</th>
                                        <th>@lang('admin.Range')</th>
                                        <th>@lang('admin.Unit')</th>
                                        <th>@lang('admin.result')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td> {{ $item['name_ar'] }} - {{ $item['name_en'] }} </td>
                                            <td>{{ $item['range'] }}</td>
                                            <td>{{ $item['unit'] }}</td>
                                            <td>
                                                <input type="text" class="form-control"
                                                    wire:model="items.{{ $index }}.result">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                    @if (!$selectedPackage?->is_urine_analysis)
                        {{-- <div class="col-md-12">
                                <div class="Patient-info right-side">
                                    <div class="fild-control mb-3">
                                        <label for="">@lang('admin.Malaria and other parasites') :</label>
                                        <textarea class="form-control" wire:model="babeosis" rows="5"></textarea>
                                    </div>
                                </div>
                            </div> --}}

                        <div class="col-md-12">
                            <div class="Patient-info right-side">
                                <div class="fild-control mb-3">
                                    <label for="">@lang('admin.report') :</label>
                                    <textarea class="form-control" wire:model="recmondations" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-12 col-md-6 d-flex align-items-center justify-content-end mt-2">
                    <button class="send-data btn btn-primary btn-sm px-4"
                        wire:click.prevent='submit'>@lang('admin.Save')</button>
                </div>
            </div>
        </div>
    </div>
</div>

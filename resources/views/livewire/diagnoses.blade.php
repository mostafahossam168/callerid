<section class="diagnostics-section main-section">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.Diagnoses') }}</h4>
        <div class="diagnostics-content bg-white p-4 rounded-2 shadow">
            <div class="row mb-3 g-3">
                <div class="col-md-8">
                    <!-- important component -->
                    <div class="row g-3">
                        <div class="col-12 col-md-3">
                            <div class="small-label">
                                <input type="text" class="ser-patirnt-id form-control mb-3 mb-md-0"
                                    wire:model="filter_patient" id="ser-patirnt-id"
                                    placeholder="{{ __('admin.Search by medical number') }}" />


                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-4">
                            <div class="small-label">
                                <select class="main-select w-100 Clinic-type mb-3 mb-md-0" id="Clinic-type" wire:model="filter_depart">
                                    <option value=''>{{ __('admin.clinics') }}</option>
                        @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                        </select>
                    </div>
                </div> --}}
                        @if (!isset($doc))
                            <div class="col-12 col-md-4">
                                <div class="small-label">
                                    <select class="main-select w-100 doctor-name mb-3 mb-md-0" id="doctor-name"
                                        wire:model='filter_dr'>
                                        <option value="">
                                            {{ __('admin.dr') }}
                                        </option>
                                        @foreach ($doctors as $dr)
                                            <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif

                        <div class="col-12 col-md-3">
                            <div class="small-label">
                                <input type="text" class="ser-patirnt-id form-control mb-3 mb-md-0"
                                    wire:model="filter_phone" id="ser-patirnt-id" placeholder="@lang('Mobile number search')" />
                            </div>
                        </div>
                    </div>
                    <!-- important component -->
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-end">
                    <div class="small-label">
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="prt-content" class="table-print">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <table class="table main-table">
                        <thead>
                            <th>{{ __('patient') }}</th>
                            <th>{{__('Animal')}}</th>
                            <th>{{ __('dr') }}</th>
                            {{-- <th>{{__('Clinic')}}</th> --}}
                            <th>{{ __('Hour') }}</th>
                            <th>{{ __('Day') }}</th>
                            <th>{{ __('Period') }}</th>
                            <th class="not-print">{{ __('actions') }}</th>
                        </thead>

                        <tbody>
                            @foreach ($diagnoses as $diagnose)
                                <tr>
                                    <td>{{ $diagnose->patient->name }}</td>
                                    <td>{{ $diagnose->animal?->name }}</td>
                                    <td>{{ $diagnose->dr->name }}</td>
                                    {{-- <td>{{$diagnose->department?->name}}</td> --}}
                                    <td>{{ $diagnose->time }}</td>
                                    <td>{{ $diagnose->day }}</td>
                                    <td>{{ __($diagnose->period) }}</td>
                                    <td class="not-print space-noWrap">
                                        <a class="preview-btn btn btn-sm btn-purple"
                                            href="{{ !isset($doc) ? route('front.diagnoses.show', $diagnose) : route('doctor.diagnose.show', $diagnose) }}">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @if (!isset($doc))
                                            <a class="btn btn-sm btn-info text-white"
                                                href="{{ route('front.diagnoses.edit', $diagnose) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endif
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete_agent{{ $diagnose->id }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('front.diagnoses.delete')
                                {{-- @include('front.diagnoses.show')  --}}
                                {{-- @include('front.diagnoses.edit') --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{ $diagnoses->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

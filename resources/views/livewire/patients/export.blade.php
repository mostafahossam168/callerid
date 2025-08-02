<div class="appoints-section main-section">
    <div class="container">
        <h4 class="main-heading mb-4">
        {{__('admin.Export owners')}}
        </h4>

        <div class="appoints-content bg-white p-4 rounded-2 shadow">
            <div class="available-appointments section-content">
                <div class="btn_holder d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">

                    <div class="d-flex align-items-center justify-content-end flex-wrap  gap-2">
                        {{-- <button class="btn  btn-sm btn-outline-primary" wire:click="export">
                            {{ __('admin.Export') }}
                            <i class="fa-solid fa-file-import"></i>
                        </button> --}}
                        <a class="btn btn-sm btn-outline-primary rounded-0" href="{{ route('front.insurants.export') }}">
                            {{ __('admin.Export') }} Excel
                            <i class="fa-solid fa-file-import"></i>
                        </a>
                    </div>
                </div>
                <div class="row g-2 mb-3">

                    <div class="col-12 col-md-4 col-lg-2 d-flex align-items-end">
                        <div class="box-info w-100">
                            <label for="appoint-date" class="small-label ">{{ __('from') }}</label>
                            <input type="date" class="form-control w-100" id="appoint-date" wire:model='from' />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2 d-flex align-items-end">
                        <div class="box-info w-100">
                            <label for="appoint-date" class="small-label ">{{ __('to') }}</label>
                            <input type="date" class="form-control w-100" id="appoint-date" wire:model='to' />
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-2">
                        <div class="box-info">
                            <label for="linic-type" class="report-name small-label">الجنس
                            </label>
                            <select class="main-select w-100 Clinic type" id="Clinic type" wire:model='gender'>
                                <option value="">اختر الحنس</option>
                                <option value="">{{__('admin.All')}}</option>
                                <option value="male">ذكر</option>
                                <option value="female">أنثى</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="table-print" id="prt-content">
                    <table class="table main-table">
                        <thead>
                            <th>{{ __('admin.patient') }}</th>
                            @can('check_phone_patients')
                            <th>{{ __('admin.Mobile') }}</th>
                            @endcan
                        </thead>
                        <tbody>
                            @forelse(App\Models\Patient::all() as $patient)
                            <tr>
                                <td class="text-nowrap">{{ $patient->name ?? __('admin.Undefined') }}</td>
                                @can('check_phone_patients')
                                <td>{{ $patient->phone ?? __('admin.Undefined') }}</td>
                                @endcan
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12"></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    {{-- @push('js')

    @endpush --}}
</div>

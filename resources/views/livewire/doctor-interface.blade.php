<div class="getHeightContainer bg-white p-3 rounded-2 shadow" x-data="{
    currentScreen: @entangle('currentScreen'),
    async setPatient(id) {
        event.preventDefault();
        await $wire.selectPatient(id);
    }

}" x-init="$watch('currentScreen', (value) => {
    event.preventDefault();
})">

    {{--    <div x-show="isLoadingPatient" --}}
    {{--         x-transition:enter="transition ease-out duration-300" --}}
    {{--         x-transition:enter-start="opacity-0" --}}
    {{--         x-transition:enter-end="opacity-100" --}}
    {{--         x-transition:leave="transition ease-in duration-300" --}}
    {{--         x-transition:leave-start="opacity-100" --}}
    {{--         x-transition:leave-end="opacity-0" --}}
    {{--         :class=" isLoadingPatient ? --}}
    {{--         'position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-50 d-flex justify-content-center align-items-center' --}}
    {{--         : '' --}}
    {{--         " --}}
    {{--         style="z-index: 9999;"> --}}
    {{--        <div x-show="isLoadingPatient" class="spinner-border text-light" role="status"> --}}
    {{--            <span class="visually-hidden">Loading...</span> --}}
    {{--        </div> --}}
    {{--    </div> --}}

    <x-alert></x-alert>
    @if ($appointment_id && $last_invoice)
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 ms-2"
                style="width: 17px;" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </svg>
            <div>
                هذه الزيارة فاتورة مدفوعة كشف طبي من الموظف {{ $last_invoice->employee?->name }}
            </div>
        </div>
    @endif
    <div class="row">
        @if ($selected_appointment)
            <div class="alert alert-danger">
                يجب عليك انهاء الجلسة لحفظ كل بيانات الجلسة من تشخيصات او وصفات طبية
            </div>
        @endif
        <div class="col-lg-3 ps-0">
            <p class="mb-2">{{ __('admin.patients') }} :</p>
            <ul class="list-unstyled main-nav-tap d-flex align-items-center flex-wrap mb-3">
                <li class="nav-item flex-fill" @click="currentScreen = 'patients_screen'">
                    <a href="#" class="nav-link active cursor-auto">
                        {{ __('admin.waiting room') }}
                        {{ doctor()->appointments()->Transferred()->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class=" d-flex flex-wrap gap-2">
                    @forelse(doctor()->appointments()->Transferred()->get() as $appointment)
                        <li class="right-b color-gr">
                            <a href="#" @click="setPatient({{ $appointment->id }})">
                                {{ $appointment->patient?->name }} | {{ $appointment->animal?->name }}<br>
                                @if ($appointment->doctor_attended_at)
                                    <span class="text-danger">@lang('admin.doctor attended at')</span> <br>
                                @elseif($appointment->attended_at)
                                    <span class="text-danger">حضر في الاستقبال</span> <br>
                                @endif
                                {{ $appointment->appointment_date }} |
                                {{ date('g:iA', strtotime($appointment->appointment_time)) }}
                            </a>
                        </li>
                        <hr>
                    @empty
                        <li class="color-gr">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
            <ul class="mt-3 list-unstyled mb-0">
                <li class="nav-item alt-bg-color" @click="currentScreen = 'patients_screen'">
                    <a href="#" class="nav-link text-white cursor-auto"
                        style="background-color: #f3ba0a !important;">
                        {{ __('admin.Suspended sessions') }}
                        {{ doctor()->appointments()->Suspend()->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class="">
                    @forelse(doctor()->appointments()->Suspend()->get() as
                    $appointment)
                        <li class="right-b" style="color: #efb70c;"><a href="#" style="color: #efb70c;"
                                class="" wire:click="selectPatient({{ $appointment->id }})">
                                {{ $appointment->patient?->name }} | {{ $appointment->animal?->name }}<br>
                                @if ($appointment->doctor_attended_at)
                                    <span class="text-danger">@lang('admin.doctor attended at')</span> <br>
                                @elseif($appointment->attended_at)
                                    <span class="text-danger">حضر في الاستقبال</span> <br>
                                @endif
                                {{ $appointment->appointment_date }} |
                                {{ date('g:iA', strtotime($appointment->appointment_time)) }}
                            </a>
                        </li>
                    @empty
                        <li class="alt-text-color" style="color: #efb70c;">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
            <ul class="mt-3 list-unstyled mb-0">
                <li class="nav-item alt-bg-color" @click="currentScreen = 'patients_screen'">
                    <a href="#" class="nav-link text-white cursor-auto">
                        {{ __('Today appointments') }}
                        {{ doctor()->appointments()->today()->where('appointment_status', 'confirmed')->count() }}
                    </a>
                </li>
            </ul>
            <div class=" main-tab-content">
                <ul class="{{ $patients_screen == 'today' ? '' : '' }}">
                    @forelse(doctor()->appointments()->today()->where('appointment_status','confirmed')->get() as
                    $appointment)
                        <li class="right-b alt-text-color"><a href="#" class="alt-text-color"
                                wire:click="selectPatient({{ $appointment->id }})">
                                {{ $appointment->patient?->name }} | {{ $appointment->animal?->name }}<br>
                                @if ($appointment->doctor_attended_at)
                                    <span class="text-danger">@lang('admin.doctor attended at')</span> <br>
                                @elseif($appointment->attended_at)
                                    <span class="text-danger">حضر في الاستقبال</span> <br>
                                @endif
                                {{ $appointment->appointment_date }} |
                                {{ date('g:iA', strtotime($appointment->appointment_time)) }}
                            </a>
                        </li>
                    @empty
                        <li class="alt-text-color">{{ __('There is no') }}</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-lg-9 mt-3 mt-lg-0">
            <div class="d-flex mb-2 align-items-start justify-content-between flex-wrap gap-2">
                <div class="d-flex mb-2 align-items-center flex-wrap gap-2">
                    <p class="mb-0">
                        {{ __('admin.Owner name') }} :
                        {{ $patient->name ?? null }}
                    </p>
                    @if ($patient->sugar ?? null or $patient->pressure ?? null or $patient->is_pregnant ?? null)
                        <div class="alert alert-danger d-flex align-items-center gap-2 mb-0 px-2 py-1" role="alert">
                            <i class="fa-solid fa-triangle-exclamation fa-fade"></i>
                            <div>
                                {{ __('The patient suffers from') }} :
                                @if ($patient->sugar)
                                    <span>{{ __('diabetes') }},</span>
                                @endif
                                @if ($patient->pressure)
                                    <span>{{ __('high blood pressure') }}, </span>
                                @endif
                                @if ($patient->is_pregnant)
                                    <span>{{ __('pregnant') }},</span>
                                @endif
                                <span>سيوله في الدم</span>
                            </div>
                        </div>
                    @endif
                </div>
                {{-- @dump($selected_appointment) --}}
                @if ($patient)

                    <div class="d-flex align-items-center gap-1">
                        @if (!$selected_appointment->doctor_attended_at)
                            <button type="button" @click="currentScreen = 'data'"
                                class="btn btn-sm btn-secondary active">
                                {{ __('Patient data') }}
                            </button>
                            <button type="button" wire:click="doctorAttended" class="btn btn-sm btn-success">
                                @lang('admin.doctor attended at')
                            </button>
                        @endif
                        <button type="submit" wire:click="suspendSession" class="btn btn-sm btn-warning">
                            {{ __('admin.Suspension of the session') }}
                        </button>
                        <button class="btn trans-btn btn-sm" data-bs-target="#trans" data-bs-toggle="modal">
                            {{ __('admin.Book a new appointment') }}</button>
                        <div class="modal fade" id="trans" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-lg">
                                <div id="prt-contenst" class="modal-content">
                                    <div class="modal-header">
                                        <h5>{{ __('admin.Book a new appointment') }}</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-4 ">
                                                <label for="patient_id"
                                                    class="small-label">{{ __('admin.patient') }}</label>
                                                <input type="text" value="{{ $patient ? $patient->name : '' }}"
                                                    readonly id="" class="form-control w-100" />
                                            </div>

                                            <div class="col-md-4 ">
                                                <label for=""
                                                    class="small-label">{{ __('admin.phone') }}</label>
                                                <input type="tel" value="{{ $patient ? $patient->phone : '' }}"
                                                    name="phone" readonly id=""
                                                    class="form-control w-100" />
                                            </div>

                                            @if ($patient->animals->count() > 0)
                                                <div class="col-md-4 ">
                                                    <label for=""
                                                        class="small-label">@lang('admin.Choose the pet')</label>
                                                    <select wire:model="animal_id" name="animal_id"
                                                        class="form-control w-100">
                                                        <option value="">{{ __('admin.choose') }}</option>
                                                        @foreach ($patient->animals as $animal)
                                                            <option value="{{ $animal->id }}">
                                                                {{ $animal->name ?? $animal->gender }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @else
                                                <p class="tip-text text-danger">{{ __('admin.Please add an animal') }}
                                                </p>
                                            @endif
                                        </div>
                                        <table class="table table-bordered mt-3">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('admin.appointment_date') }}</th>
                                                    <th>{{ __('admin.Period') }}</th>
                                                    <th>{{ __('admin.appointment_time') }}</th>
                                                    <th>{{ __('admin.actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($new_appointments as $index => $item)
                                                    <tr>
                                                        <td>
                                                            <label for="appointment_date"
                                                                class="small-label mb-2">{{ __('admin.appointment_date') }}</label>
                                                            <input type="date"
                                                                wire:change="getTimes({{ $index }},$event.target.value,'{{ $new_appointments[$index]['appointment_duration'] }}')"
                                                                wire:model="new_appointments.{{ $index }}.appointment_date"
                                                                class="form-control">
                                                        </td>
                                                        <td>
                                                            <label for="appointment_time"
                                                                class="small-label mb-2">{{ __('Period') }}</label>
                                                            <select
                                                                wire:model="new_appointments.{{ $index }}.appointment_duration"
                                                                wire:change="getTimes({{ $index }},'{{ $new_appointments[$index]['appointment_date'] }}',$event.target.value)"
                                                                id="" class="main-select w-100">
                                                                <option value="">{{ __('admin.Period') }}
                                                                </option>
                                                                <option
                                                                    wire:click="getTimes({{ $index }},'{{ $new_appointments[$index]['appointment_date'] }}',$event.target.value)"
                                                                    value="morning">{{ __('admin.morning') }}
                                                                </option>
                                                                <option
                                                                    wire:click="getTimes({{ $index }},'{{ $new_appointments[$index]['appointment_date'] }}',$event.target.value)"
                                                                    value="evening">{{ __('admin.evening') }}
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <label for="appointment_time"
                                                                class="small-label mb-2">{{ __('admin.appointment_time') }}</label>
                                                            <select
                                                                wire:model="new_appointments.{{ $index }}.appointment_time"
                                                                id="" class="main-select w-100">
                                                                <option value="">
                                                                    {{ __('admin.appointment_time') }}
                                                                </option>
                                                                @foreach ($new_appointments[$index]['times'] as $time)
                                                                    @if (!in_array($time, $this->new_appointments[$index]['reservedTimes']))
                                                                        <option value="{{ $time }}">
                                                                            {{ date('g:iA', strtotime($time)) }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            @if ($index == 0)
                                                                <button class="btn btn-success btn-sm"
                                                                    wire:click="addNewAppoinment"><i
                                                                        class="fa fa-plus"></i></button>
                                                            @endif
                                                            @if ($index > 0)
                                                                <button class="btn btn-danger btn-sm"
                                                                    wire:click="removeAppoinment({{ $index }})"><i
                                                                        class="fa fa-trash"></i></button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-4 d-flex align-items-end">
                                            <button type="submit" wire:click="saveAppointment"
                                                class="btn btn-sm btn-success w-100">{{ __('admin.save') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a target="_blank" class="btn-main-sm"
                            href="{{ route('doctor.invoices.index', ['patient' => $patient->id]) }}">{{ __('admin.patient bills') }}</a>
                        <button type="submit" wire:click="endSession" class="btn btn-sm btn-danger">
                            {{ __('End Session') }}
                        </button>
                    </div>
                @endif
            </div>
            <div>
                {{-- alert success --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <ul class="nav nav-pills main-nav-tap mb-3" style="flex-wrap: wrap !important;">
                <li class="nav-item" @click="currentScreen = 'pathological-information'">
                    <a href="#" class="nav-link "
                        :class="currentScreen == 'pathological-information' ? 'active' : ''">
                        @lang('admin.pathological_information')
                    </a>
                </li>
                <li class="nav-item" @click="currentScreen = 'current'">
                    <a href="#" class="nav-link " :class="currentScreen == 'current' ? 'active' : ''">
                        {{ __('current diagnosis') }}
                    </a>
                </li>
                <li class="nav-item" @click="currentScreen = 'trans'">
                    <a href="#" class="nav-link " :class="currentScreen == 'trans' ? 'active' : ''">
                        {{ __('transfer of the patient') }}
                    </a>
                </li>
                <li class="nav-item" @click="currentScreen = 'invoice'">
                    <a href="#" class="nav-link " :class="currentScreen == 'invoice' ? 'active' : ''">
                        {{ __('Issuance of invoice') }}
                    </a>
                </li>
                @if (setting()->pharmacy_status)
                    <li class="nav-item" @click="currentScreen = 'describe'">
                        <a href="#" class="nav-link " :class="currentScreen == 'describe' ? 'active' : ''">
                            @lang('pharmacy')
                        </a>
                    </li>
                @endif

                <li class="nav-item" @click="currentScreen = 'prev'">
                    <a href="#" class="nav-link  " :class="currentScreen == 'prev' ? 'active' : ''">
                        {{ __('previous diagnoses') }}
                    </a>
                </li>


                <li class="nav-item" @click="currentScreen = 'scan'">
                    <a href="#" class="nav-link " :class="currentScreen == 'scan' ? 'active' : ''">
                        {{ __('Radiation Requests') }}
                    </a>
                </li>
                @if (setting()->active_scan_and_lab == '1')
                @endif

                <li class="nav-item" @click="currentScreen = 'lab'">
                    <a href="#" class="nav-link " :class="currentScreen == 'lab' ? 'active' : ''">
                        {{ __('Lab') }}
                    </a>
                </li>

            </ul>
            <div class=" main-tab-content">
                {{-- @dump($selected_appointment?->animal) --}}
                @if ($patient)
                    <div x-show="currentScreen === 'pathological-information'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.pathological-information')
                    </div>
                    <div x-show="currentScreen === 'current'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.current')
                    </div>
                    <div x-show="currentScreen === 'invoice'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.invoice')
                    </div>
                    <div x-show="currentScreen === 'describe'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.describe')
                    </div>
                    <div x-show="currentScreen === 'prev'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.prev')
                    </div>
                    <div x-show="currentScreen === 'trans'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.trans')
                    </div>
                    <div x-show="currentScreen === 'scan'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.scan')
                    </div>
                    <div x-show="currentScreen === 'lab'" x-transition:enter.duration.500ms>
                        @include('doctor.interfaces.lab')
                    </div>
                @else
                    {{ __('Please click on the patients name') }}
                @endif

            </div>
        </div>
    </div>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        function select2init() {
            $('.select2:not(.select2-hidden-accessible)').each(function() {
                $(this).select2();

                $(this).on('change', function() {
                    var data = $(this).val();
                    var name = $(this).attr('wire:model');
                    @this.
                    set(name, data);
                });
            });
        }

        select2init();

        document.addEventListener('refreshSelect2', () => {
            select2init();
        });
    </script>
</div>

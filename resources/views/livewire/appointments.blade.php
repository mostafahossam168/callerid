<div class="appoints-section main-section">
    <div class="container-fluid">
        <h4 class="main-heading mb-4">
            @if ($transferred)
                {{ __('admin.Referrals_to_the_doctor') }}
            @else
                {{ __('admin.Appointments') }}
            @endif
        </h4>
        @if ($transferred)
            <div class="alert alert-primary" role="alert">
                <p class="mb-0">
                    {{ __('admin.meassage_referrals_doctor') }}
                </p>
            </div>
        @endif
        <div class="appoints-content bg-white p-4 rounded-2 shadow">
            <div class="available-appointments section-content">
                @can('read_appointments')
                    <div class="btn_holder d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="d-flex align-items-center gap-1">
                            <button type="button" class="btn btn-danger btn-sm px-3" data-bs-toggle="modal"
                                data-bs-target="#bulkdelete" id="btn_delete_all">
                                {{ __('admin.Delete all') }}
                            </button>
                            <div class="btn-holder">
                                <button wire:click="resetAll"
                                    class="btn trans-btn btn-sm px-4">{{ __('All Appointments') }}</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-end flex-wrap gap-1">
                            <button id="btn-prt-content" class="btn btn-sm btn-warning">
                                <i class="fa fa-print"></i>
                            </button>
                            @if (!$transferred)
                                <a href="{{ route('front.appointments.create') }}" class="btn-main-sm">
                                    {{ __('admin.Book a new appointment') }}
                                    <i class="me-1 fa-solid fa-calendar-days"></i>
                                </a>
                            @endif
                            <a class="btn btn-primary btn-sm" href="{{ route('front.appointments_info') }}">
                                {{ __('Appointments Data') }}
                                <i class="me-1 fa-solid fa-calendar-days"></i>
                            </a>
                        </div>
                    </div>
                @endcan
                <div class="row g-2 mb-3">
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="box-info">
                            <label for="the-doctor"
                                class="report-name small-label text-nowrap">{{ __('admin.Search by File number or mobile number') }}</label>
                            <input wire:model="search" class="form-control">
                        </div>
                    </div>
                    @if (!$transferred)
                        <div class="col-12 col-md-4 col-lg-3 col-xl-2 d-flex align-items-end">
                            <div class="box-info w-100">
                                <label for="appoint-date" class="small-label ">{{ __('admin.Date') }}</label>
                                <input type="date" class="form-control w-100" id="appoint-date" wire:model='date' />
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                        <div class="box-info">
                            <label for="linic-type" class="report-name small-label">{{ __('admin.Clinic') }}
                            </label>
                            <select class="main-select w-100 Clinic type" id="Clinic type" wire:model='department'>
                                <option value="">{{ __('admin.Choose Clinic') }}</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                        <div class="box-info">
                            <label for="linic-type"
                                class="report-name small-label">{{ __('admin.Daily appointments') }}
                            </label>
                            <select class="main-select w-100 Clinic type" id="Clinic type"
                                wire:model='today_or_yasterday'>
                                <option value="">{{ __('admin.Choose today') }}</option>
                                <option value="today">{{ __('admin.Today') }}</option>
                                <option value="yesterday">{{ __('admin.Yesterday') }}</option>
                                <option value="tomorrow">{{ __('admin.Tomorrow') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 col-xl-2">
                        <div class="box-info">
                            <label for="the-doctor" class="report-name small-label">{{ __('admin.dr') }}</label>
                            <select class="main-select w-100 the-doctor" id="the-doctor" wire:model='dr'>
                                <option value="">{{ __('admin.Choose the doctor') }}</option>
                                @foreach ($doctors as $dr)
                                    <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if (!$transferred)
                        <div class="col-12 col-md-4 col-lg-2">
                            <div class="box-info">
                                <label for="duration" class="report-name small-label">{{ __('admin.Period') }}
                                </label>
                                <select class="main-select w-100 duration" id="duration" wire:model='period'>
                                    <option value="">{{ __('admin.Period') }}</option>
                                    <option value="morning">{{ __('admin.morning') }}</option>
                                    <option value="evening">{{ __('admin.evening') }}</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="table-print" id="prt-content">
                <x-header-invoice></x-header-invoice>
                <div class="table-responsive">
                    <div class="table-print">
                        <table class="table main-table">
                            <thead>
                                <th class="not-print"> <input type="checkbox" name="select_all" id="select-all"> </th>
                                <th>{{ __('admin.medical_number') }}</th>
                                <th>{{ __('admin.patient') }}</th>
                                @can('check_phone_patients')
                                    <th>{{ __('admin.Mobile') }}</th>
                                @endcan
                                <th>{{ __('admin.doctor') }}</th>
                                <th>{{ __('admin.clinic') }}</th>

                                <th>{{ __('admin.animal') }}</th>

                                <th>{{ __('admin.appointment_status') }}</th>
                                <th>{{ __('admin.appointment_time') }}</th>
                                <th>{{ __('admin.appointment_date') }}</th>
                                <th class="not-print">{{ __('admin.actions') }}</th>
                            </thead>
                            <tbody>
                                @forelse($appoints as $appointment)
                                    <tr>
                                        <td class="not-print">
                                            <div class="animated-checkbox">
                                                <label class="m-0">
                                                    <input type="checkbox" value="{{ $appointment->id }}"
                                                        name="delete_select" id="delete_select">
                                                    <span class="label-text"></span>
                                                </label>
                                            </div>
                                        </td>

                                        <td>{{ $appointment->patient->id ?? __('admin.Undefined') }}</td>
                                        <td class="text-nowrap">
                                            {{ $appointment->patient->name ?? __('admin.Undefined') }}
                                        </td>
                                        @can('check_phone_patients')
                                            <td class="text-nowrap">
                                                {{ $appointment->patient->phone ?? __('admin.Undefined') }}
                                            </td>
                                        @endcan
                                        <td class="text-nowrap">
                                            {{ $appointment->doctor->name ?? __('admin.Undefined') }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $appointment->clinic->name ?? __('admin.Undefined') }}
                                        </td>
                                        {{-- <td></td> --}}
                                        <td class="text-nowrap">{{ $appointment->animal?->name }}</td>

                                        <td>{{ __($appointment->appointment_status) }}</td>
                                        <td class="text-nowrap">
                                            {{ $appointment->appointment_time ?? __('admin.Undefined') }}
                                        </td>
                                        <td class="text-nowrap">
                                            {{ $appointment->appointment_date ?? __('admin.Undefined') }}
                                        </td>
                                        <td
                                            class="not-print d-flex flex-lg-column align-items-center justify-content-center gap-1">
                                            <form id="delete-{{ $appointment->id }}-form" method="POST"
                                                action="{{ route('front.appointments.destroy', $appointment) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                @if ($appointment->appointment_status == 'pending')
                                                    @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                                        <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                            data-bs-target="#confirmationModal{{ $appointment->id }}"
                                                            data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                            data-bs-placement="top" data-bs-title="حضور"><i
                                                                class="fa-solid fa-check"></i></button>
                                                        {{-- <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmationModal{{ $appointment->id }}">{{ __('admin.Presence') }}</button>
                                            --}}

                                                        <div class="modal fade"
                                                            id="confirmationModal{{ $appointment->id }}"
                                                            tabindex="-1" aria-labelledby="confirmationModalLabel"
                                                            aria-hidden="true" wire:ignore>
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="confirmationModalLabel">تأكيد
                                                                            الحضور</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>سيتم ظهور المريض في صفحة الطبيب. لا يمكن
                                                                            التراجع عن هذا
                                                                            الإجراء !!</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">إلغاء</button>
                                                                        <button type="button" class="btn btn-success"
                                                                            wire:click="presence({{ $appointment }})"
                                                                            id="confirmPresence"
                                                                            data-bs-dismiss="modal">موافق</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-sm btn-danger"
                                                            wire:click="notPresence({{ $appointment }})"
                                                            data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                            data-bs-placement="top" data-bs-title="لم يحضر"><i
                                                                class="fa-solid fa-xmark"></i></button>
                                                        <button class="btn btn-sm closeBtn-Color text-white w-fit"
                                                            wire:click="cancelled({{ $appointment }})"
                                                            data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                            data-bs-placement="top" data-bs-title="ملغيه"><i
                                                                class="fa-solid fa-ban"></i></button>
                                                    @endif
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="examined({{ $appointment }})"
                                                        data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                        data-bs-placement="top" data-bs-title="تم الكشف"><i
                                                            class="fa-solid fa-stethoscope"></i></button>
                                                @endif
                                            </div>

                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                                    <button class="btn btn-sm btn-success"
                                                        wire:click="presence({{ $appointment }})"
                                                        data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                        data-bs-placement="top" data-bs-title="حضور"><i
                                                            class="fa-solid fa-check"></i></button>
                                                    <button class="btn btn-sm btn-danger"
                                                        wire:click="notPresence({{ $appointment }})"
                                                        data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip"
                                                        data-bs-placement="top" data-bs-title="لم يحضر"><i
                                                            class="fa-solid fa-xmark"></i></button>
                                                @endif
                                                @if ($appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                                    <span class="btn btn-sm btn-success">حضر</span>
                                                @elseif ($appointment->appointment_status == 'cancelled')
                                                    <span class="btn btn-sm btn-danger">لم يحضر</span>
                                                @else
                                                @endif
                                                <a onclick="onChange()" id="linkForWhats"
                                                    href="https://wa.me/{{ $appointment->patient->phone }}"
                                                    target="_blank">
                                                    <img src="{{ asset('img/whatsapp.png') }}" alt="whatsapp"
                                                        width="34">
                                                </a>
                                                <a href="#showPrintRow{{ $appointment->id }}" data-bs-toggle="modal"
                                                    data-id="{{ $appointment->id }}"
                                                    class="btn btn-sm btn-purple myButton">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <!-- Modal show Print Row -->
                                                <div class="modal fade" id="showPrintRow{{ $appointment->id }}"
                                                    data-bs-keyboard="false" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                                    {{ __('admin.Data preview') }}
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-print"
                                                                    id="prt-content1{{ $appointment->id }}">
                                                                    <x-header-invoice></x-header-invoice>
                                                                    <div class="table-responsive">
                                                                        <table class="table main-table">
                                                                            <tr>
                                                                                <th>{{ __('admin.medical_number') }}
                                                                                </th>
                                                                                <th>{{ __('admin.patient') }}</th>
                                                                                @can('check_phone_patients')
                                                                                    <th>{{ __('admin.Mobile') }}</th>
                                                                                @endcan
                                                                                <th>{{ __('admin.doctor') }}</th>
                                                                                <th>{{ __('admin.clinic') }}</th>
                                                                                <th>{{ __('admin.appointment_status') }}
                                                                                </th>
                                                                                <th>{{ __('admin.appointment_time') }}
                                                                                </th>
                                                                                <th>{{ __('admin.appointment_date') }}
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>{{ $appointment->patient->id ?? __('admin.Undefined') }}
                                                                                </td>
                                                                                <td class="text-nowrap">
                                                                                    {{ $appointment->patient->name ?? __('admin.Undefined') }}
                                                                                </td>
                                                                                @can('check_phone_patients')
                                                                                    <td>{{ $appointment->patient->phone ?? __('admin.Undefined') }}
                                                                                    </td>
                                                                                @endcan
                                                                                <td class="text-nowrap">
                                                                                    {{ $appointment->doctor->name ?? __('admin.Undefined') }}
                                                                                </td>
                                                                                <td>{{ $appointment->clinic->name ?? __('admin.Undefined') }}
                                                                                </td>
                                                                                <!-- <td class="text-nowrap">
                                                                                {{ $appointment->room->name ?? __('admin.Undefined') }}
                                                                            </td> -->
                                                                                <!-- <td>{{ __($appointment->appointment_status) }}
                                                                            </td> -->
                                                                                <td>{{ __($appointment->appointment_status) }}
                                                                                </td>
                                                                                <td>{{ $appointment->appointment_time ?? __('admin.Undefined') }}
                                                                                </td>
                                                                                <td class="text-nowrap">
                                                                                    {{ $appointment->appointment_date ?? __('admin.Undefined') }}
                                                                                </td>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-secondary btn-sm px-3"
                                                                    data-bs-dismiss="modal">{{ __('admin.Back') }}</button>
                                                                <button type="button"
                                                                    class="btn btn-warning btn-sm px-3 print-btn"
                                                                    id="btn-prt-content1{{ $appointment->id }}"
                                                                    data-id="{{ $appointment->id }}">
                                                                    {{ __('admin.print') }}
                                                                    <i class="fa fa-print"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <a href="{{ route('front.appointments.edit', $appointment) }}" class="btn btn-sm btn-info">
                                                <i class="fa fa-pen-to-square"></i>
                                            </a>
                                            <button class="btn btn-sm btn-danger" form="delete-{{ $appointment->id }}-form">
                                                <i class="fa fa-trash-can"></i>
                                            </button> -->
                                                <div class="dropdown drop-table dropend">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item text-center"
                                                                href="{{ route('front.appointments.edit', $appointment) }}">
                                                                <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                                تعديل
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="dropdown-item text-center text-danger"
                                                                data-bs-toggle="modal" data-bs-placement="top"
                                                                data-bs-title="حذف"
                                                                form="delete-{{ $appointment->id }}-form"
                                                                data-bs-target="#delete_agent{{ $appointment->id }}">
                                                                <i class="fa-solid fa-trash-can"></i>
                                                                حذف
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @include('front.appointment.action')
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">{{ __('admin.no_appointments') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- @push('js')

    @endpush --}}
</div>

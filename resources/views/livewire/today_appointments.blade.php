<div class="appoints-section main-section" wire:poll.30000ms>
    <div class="container-fluid">
        <h4 class="main-heading mb-4">
            {{ __('admin.today_appointments') }}
        </h4>
        <div class="appoints-content bg-white p-4 rounded-2 shadow">
            <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                <div class="box-info">
                    <label for="linic-type" class="small-label">@lang('Choose department')
                    </label>
                    <select class="main-select w-100 Clinic type" id="linic-type" wire:model.live='filter_depart'>
                        <option value="">@lang('Choose')</option>
                        @foreach (\App\Models\Department::all() as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="box-info">
                    <label for="linic-type" class="small-label">@lang('Choose doctor')
                    </label>
                    <select class="main-select w-100 Clinic type" id="linic-type" wire:model.live='filter_dr'>
                        <option value="">@lang('Choose')</option>
                        @foreach (\App\Models\User::doctors()->get() as $dr)
                        <option value="{{ $dr->id }}">{{ $dr->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        {{-- <th>{{__('admin.tax')}}</th> --}}
                        <th>{{ __('admin.medical_number') }}</th>
                        <th>{{ __('admin.patient') }}</th>
                        <th>{{ __('Patient File') }}</th>
                        <th>{{ __('admin.mobile') }}</th>
                        <!-- <th>{{ __('admin.nationality') }}</th> -->
                        <th>{{ __('admin.doctor') }}</th>
                        <th>{{ __('admin.clinic') }}</th>
                        <th>{{ __('admin.appointment_status') }}</th>
                        <th>{{ __('admin.appointment_time') }}</th>
                        <th>{{ __('admin.appointment_date') }}</th>
                        <th class="not-print">{{ __('actions') }}</th>
                    </thead>
                    <tbody>
                        @forelse($appoints as $appointment)
                        <tr>
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->id ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->patient->phone ?? 'لم يحدد' }}</td>
                            <!-- <td>{{ $appointment->patient->country->name ?? 'لم يحدد' }}</td> -->
                            <td>{{ $appointment->doctor->name ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->clinic->name ?? 'لم يحدد' }}</td>
                            <td>{{ __($appointment->appointment_status) }}</td>
                            <td>{{ $appointment->appointment_time ?? 'لم يحدد' }}</td>
                            <td>{{ $appointment->appointment_date ?? 'لم يحدد' }}</td>
                            <td class="not-print d-flex gap-1">

                                @if ($appointment->appointment_status == 'pending')
                                <form id="cancel-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.update', $appointment) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="appointment_status" value="cancelled">
                                </form>
                                @endif
                                @if (!$appointment->attended_at and $appointment->appointment_status != 'cancelled')
                                <button class="btn btn-sm btn-success" wire:click="presence({{ $appointment }})" data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip" data-bs-placement="top" data-bs-title="حضور"><i class="fa-solid fa-check"></i></button>
                                <button class="btn btn-sm btn-danger" wire:click="notPresence({{ $appointment }})" data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip" data-bs-placement="top" data-bs-title="لم يحضر"><i class="fa-solid fa-xmark"></i></button>
                                <button class="btn btn-sm closeBtn-Color text-white w-fit" wire:click="cancelled({{ $appointment }})" data-bs-toggle="tooltip" data-bs-custom-class="sm-tooltip" data-bs-placement="top" data-bs-title="ملغيه"><i class="fa-solid fa-ban"></i></button>
                                @endif

                                <!-- <a href="{{ route('front.appointments.edit', $appointment) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-pen-to-square"></i>
                                </a>
                                <form id="delete-{{ $appointment->id }}-form" method="POST" action="{{ route('front.appointments.destroy', $appointment) }}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <button class="btn btn-sm btn-danger" form="delete-{{ $appointment->id }}-form">
                                    <i class="fa fa-trash-can"></i>
                                </button> -->
                                <div class="dropdown drop-table">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-center" href="{{ route('front.appointments.edit', $appointment) }}">
                                                <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                تعديل
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item text-center text-danger" form="delete-{{ $appointment->id }}-form" data-bs-toggle="modal" data-bs-placement="top" data-bs-title="حذف" data-bs-target="#delete_agent{{ $appointment->patient?->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                                حذف
                                            </button>
                                        </li>
                                    </ul>
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
                {{ $appoints->links() }}
            </div>
        </div>
    </div>
</div>

<div class="bg-white p-3 rounded-2 shadow">
    @can('read_appointments')
    <div class="buttons-holder d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
        <div class="right-side d-flex align-items-center justify-content-start">
            <button wire:click="resetData" class="sec-btn-gre px-4">{{ __('All Appointments') }}</button>
        </div>
        <div class="left-side d-flex align-items-center justify-content-end flex-wrap gap-1">
            <button id="btn-prt-content" class="btn btn-warning rounded-1 px-2">
                <i class="fa-solid fa-print"></i>
            </button>
            <button wire:click="$set('screen','create')" class="btn-main-sm">
                {{ __('admin.Book a new appointment') }}
                <i class="fa-solid fa-calendar-days me-1"></i>
            </button>
            <a class="btn btn-primary btn-sm" href="{{ route('doctor.appointments_info') }}">
                {{ __('Appointments Data') }}
                <i class="fa-solid fa-calendar-days me-1"></i>
            </a>
        </div>
    </div>
    @endcan
    @if ($screen == 'index')
    <div class="row g-2 mb-3">
        <div class="col-12 col-md-3">
            <label for="appoint-date" class="small-label mb-2">{{ __('Date') }}</label>
            <input type="date" class="form-control" wire:model="date" id="appoint-date" />
        </div>

        <div class="col-12 col-md-3">
            <label for="duration" class="small-label mb-2">{{ __('Period') }} </label>
            <select class="main-select w-100 duration" wire:model="period" id="duration">
                <option value="">{{ __('Choose the period') }}</option>
                <option value="<=">{{ __('Morning time') }}</option>
                <option value=">=">{{ __('Evening time') }}</option>
            </select>
        </div>

        <div class="col-12 col-md-3">
            <label for="duration" class="small-label mb-2">{{__('admin.Today')}} </label>
            <select class="main-select w-100 duration" wire:model="app_day" id="day">
                <option value="">{{__('admin.Choose today')}}</option>
                <option value="today">{{__('admin.Today')}}</option>
                <option value="yesterday">{{__('admin.Yesterday')}}</option>
                <option value="tommorow">{{__('admin.Tomorrow')}}</option>
            </select>
        </div>
    </div>

    <div class="table-print" id="prt-content">
        <x-header-invoice></x-header-invoice>
        <div class="table-responsive">
            <table class="table main-table">
                <thead>
                    <th>{{ __('admin.department') }}</th>
                    <th>{{ __('admin.doctor') }}</th>
                    <th>{{ __('admin.patient') }}</th>
                    <th>{{ __('admin.appointment_status') }}</th>
                    <th>{{ __('admin.appointment_time') }}</th>
                    <th>{{ __('admin.appointment_date') }}</th>
                    <th class="not-print">{{ __('admin.actions') }}</th>
                </thead>
                <tbody>
                    @forelse($appoints as $appointment)
                    <tr>
                        <td>{{ $appointment->clinic->name ?? __('admin.Undefined') }}</td>
                        <td>{{ $appointment->doctor->name ?? __('admin.Undefined') }}</td>
                        <td>{{ $appointment->patient->name ?? __('admin.Undefined') }}</td>
                        <td>{{ __('admin.' . $appointment->appointment_status) }}</td>
                        <td>{{ $appointment->appointment_time ?? __('admin.Undefined') }}</td>
                        <td>{{ $appointment->appointment_date ?? __('admin.Undefined') }}</td>
                        <td class="not-print">
                            <button data-bs-toggle="modal" data-bs-target="#add_or_update" class="btn btn-sm btn-info text-white py-2" wire:click='edit({{ $appointment }})'>
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            @if ($appointment->appointment_status == 'pending')
                            <button class="btn btn-sm btn-info" wire:click="cancel({{ $appointment->id }})">الغاء</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">{{ __('admin.no_appointments') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @else
    @include('doctor.appointments.create_or_edit')
    @endif
</div>

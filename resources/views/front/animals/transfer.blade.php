<div class="modal fade" id="trans" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div id="prt-contenst" class="modal-content">
            <div class="modal-header">
                @if ($trans_patient)
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ __('Transfer of the patient') }}
                        {{ $trans_patient->name }}
                        {{ __('to the doctor') }}
                    </h5>
                @endif
                <div class="d-flex gap-3 align-items-center mt-3 ">
                    <small class="ms-2">
                        {{ __('Date') }} :
                        <span class="text-main-color">{{ date('Y-m-d') }}</span>
                    </small>
                    <small class="ms-2">
                        {{ __('Day') }} :
                        <span class="text-main-color">{{ Carbon::now()->translatedFormat('D') }}</span>
                    </small>
                    <small>
                        {{ __('Hour') }} :
                        <span class="text-main-color">{{ date('H:i') }}</span>
                    </small>
                </div>
            </div>

            <div class="modal-body">
                <input name="employee_id" type="hidden" value="{{ auth()->id() }}">
                {{-- <input name="patient_id" type="text" value="{{ $patient->id }}"> --}}
                <p class="mb-3 sm-heading">{{ __('Direct Doctor Transfer') }}</p>
                @if ($trans_patient)
                    @if ($trans_patient->invoices()->unpaid()->count() > 0)
                        <div class=" px-3  mb-2 alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="me-4 mb-0 d-flex align-items-center gap-2 ">
                                    يوجد لدى المريض فواتير غير مسددة
                                    <i class="fa-solid fa-triangle-exclamation fa-fade fa-lg"
                                        style="--fa-animation-duration: 2s;"></i>

                                </p>
                                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                @endif
                {{-- @dump(\App\Models\User::whereHas('departments',function($q) use ($clinic_id){
                $q->where('departments.id',1); })->get()) --}}
                {{--
                <livewire:select-doctor-for-transfer /> --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4 col-lg-3 text-end">
                        <label class="small-label" for=""> {{ __('Clinic') }} </label>
                        <select wire:model="clinic_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.Clinic') }}</option>
                            @foreach (\App\Models\Department::where('transferstatus', 1)->get() as $department)
                                <option value="{{ $department->id }}">
                                    {{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3 text-end">
                        <label class="small-label" for=""> {{ __('the Doctor') }} </label>
                        <select wire:model="doctor_id" class="main-select w-100 trans-select-color" id="">
                            <option value="">{{ __('admin.dr') }}</option>
                            @if ($clinic_id)
                                @php
                                    $users_id = \App\Models\UserDepartment::where('department_id', $clinic_id)->pluck('user_id');
                                    $doctors = \App\Models\User::doctors()
                                        ->whereHas('departments', function ($query) use ($clinic_id) {
                                            $query->where('departments.id', $clinic_id);
                                        })
                                        ->get();
                                @endphp
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3 text-end">
                        <label for="appointment_date" class=" small-label">{{ __('Period') }}</label>
                        <select wire:model="appointment_duration" class="main-select w-100 trans-select-color">
                            <option value="">{{ __('admin.Period') }}</option>
                            <option value="morning">{{ __('admin.morning') }}</option>
                            <option value="evening">{{ __('admin.evening') }}</option>
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3 text-end">
                        <label class="small-label" for=""> {{ __('waiting number') }} </label>
                        <input type="number" value="{{ $waiting }}" readonly class="form-control">
                    </div>
                </div>
                {{-- <div class="row g-3">
                    <div class="col-md-3 ">
                        <label class="small-label" for="">{{__('admin.Age')}}</label>
                        <input type="text" wire:model="age" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="small-label" for=""> {{__('admin.the weight')}}</label>
                        <input type="text" wire:model="weight" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="small-label" for=""> {{__('admin.breathing_rate')}}</label>
                        <input type="text" wire:model="breathing_rate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="small-label" for=""> {{__('admin.heart_rate')}}</label>
                        <input type="text" wire:model="heart_rate" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="small-label" for=""> {{__('admin.temperature_rate')}}</label>
                        <input type="text" wire:model="temperature" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label for="room_id">{{ __('admin.room') }}</label>

                        <select wire:model="room_id" id="room_id" class="main-select w-100">
                            <option>{{ __('Choose a room') }}</option>
                            @foreach (\App\Models\Room::all() as $room)
                            @php
                            $appointment = \App\Models\Appointment::where('room_id', $room->id)
                            ->whereIn('appointment_status', ['confirmed', 'pending', 'transferred'])
                            ->first();
                            @endphp
                            @if (!$appointment)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('room_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger px-5"
                    data-bs-dismiss="modal">{{ __('admin.back') }}</button>
                <button wire:click="submit_transfer({{ setting()->active_transfer_print }})" class="btn-main-sm px-5"
                    data-bs-dismiss="modal">{{ __('transfer') }}</button>
            </div>
        </div>
    </div>
</div>

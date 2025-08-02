<div>
    @if (!setting()->from_morning && !setting()->to_morning && !setting()->from_evening && !setting()->to_evening)
    <div class="alert alert-danger">
        {{ __('admin.Please add working hours from the page') }} <a href="{{ route('admin.settings') }}">{{ __('admin.settings') }}</a>
    </div>
    @endif
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
    <x-alert></x-alert>
    @include('front.unpaidInvoicePop')
    <div class="row g-3">
        <div class="col-md-4 ">
            <label for="" class="small-label mb-2">{{ __('Search with ID number or mobile number') }}</label>
            <input type="text" wire:model="patient_key" wire:keyup.debounce.300ms='get_patient' class="form-control">
        </div>
        <div class="col-md-4 ">
            <label for="patient_id" class="small-label mb-2">{{ __('admin.patient') }}</label>
            <label for="" class="small-label">{{ __('admin.patient') }}</label>
            <input type="text" value="{{ $patient ? $patient->name : '' }}" readonly id="" class="form-control w-100" />
        </div>

        <div class="col-md-4 ">
            <label for="" class="small-label">{{ __('admin.phone') }}</label>
            <input type="tel" value="{{ $patient ? $patient->phone : '' }}" name="phone" readonly id="" class="form-control w-100" />
        </div>
        {{-- @if ($noResults)
    <div class="col-md-12 alert alert-danger mt-3">
        {{ __('No results found') }}
    </div>
    @endif --}}
    <div class="col-md-4">
        <label for="clinic_id" class="small-label mb-2">{{ __('admin.clinic') }}</label>
        <select wire:model="clinic_id" id="clinic_id" class="main-select w-100">
            <option>{{ __('Choose a clinic') }}</option>
            @foreach (\App\Models\Department::where('appointmentstatus', 1)->get() as $clinic)
            <option value="{{ $clinic->id }}">{{ $clinic->name }}</option>
            @endforeach
        </select>

    </div>

    <div class="col-md-4">
        <label for="doctor_id" class="small-label mb-2">{{ __('admin.doctor') }}</label>
        <select wire:model="doctor_id" id="doctor_id" class="main-select w-100">
            <option>{{ __('Choose a doctor') }}</option>
            @if ($clinic_id)
            @foreach (\App\Models\User::doctors()->whereRelation('departments','department_id',$clinic_id)->get() as $doctor)
            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
            @endforeach
            @endif
        </select>

    </div>

    <div class="col-md-4">
        <label for="animal_id" class="small-label mb-2">{{ __('admin.animal') }}</label>
        <select wire:model="animal_id" id="animal_id" class="main-select w-100">
            {{-- <option>{{ __('Choose a animal') }}</option> --}}
            <option>@lang('admin.Choose the pet')</option>

            @foreach ($patient->animals ?? [] as $animal)
            <option value="{{ $animal->id }}">{{ $animal->name }}</option>
            @endforeach

        </select>

    </div>

    <div class="col-md-4">
        <label for="animal_id" class="small-label mb-2">{{ __('admin.Service name') }}</label>
        <select wire:model="product_id" id="product_id" class="main-select w-100">
            <option>@lang('admin.choose')</option>
            @foreach ($products ?? [] as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
    </div>


    {{-- <div class="col-md-4 "> --}}
    {{-- <label for="appointment_status">{{__('admin.appointment_status')}}</label> --}}
    {{-- <select name="appointment_status" wire:model="appointment.appointment_status" id="appointment_status"
                class="form-control"> --}}
    {{-- <option value="{{__('admin.pending')}}">{{__('admin.pending')}}</option> --}}
    {{-- <option value="{{__('admin.confirmed')}}">{{__('admin.confirmed')}}</option> --}}
    {{-- <option value="{{__('admin.canceled')}}">{{__('admin.canceled')}}</option> --}}
    {{-- </select> --}}
    {{-- @error('appointment_status') --}}
    {{-- <span class="text-danger">{{ $message }}</span> --}}
    {{-- @enderror --}}
    {{-- </div> --}}
    <div class="col-md-4 ">
        <label for="appointment_time" class="small-label mb-2">{{ __('Period') }}</label>
        <select wire:model="appointment_duration" id="" class="form-control">
            <option value="">{{ __('admin.Period') }}</option>
            <option value="morning">{{ __('admin.morning') }}</option>
            <option value="evening">{{ __('admin.evening') }}</option>
        </select>

    </div>

    <div class="col-md-4 d-flex flex-column justify-content-end">
        <label for="appointment_date" class="small-label mb-2">{{ __('admin.appointment_date') }}</label>
        <input type="date" wire:model="appointment_date" id="appointment_date" class="form-control">

    </div>

    <div class="col-md-4 ">
        <label for="appointment_time" class="small-label mb-2">{{ __('admin.appointment_time') }}</label>
        <select wire:model.defer="appointment_time" id="" class="form-control">
            <option value="">{{ __('admin.appointment_time') }}</option>

            @foreach ($times as $time)
            @if (!in_array($time, $reservedTimes))
            <option value="{{ $time }}">{{ date('g:iA', strtotime($time)) }}</option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="col-4 d-flex align-items-end">
        <button type="submit" wire:click="save" class="btn btn-sm btn-success w-100">{{ __('admin.save') }}</button>
    </div>
</div>
{{-- Because she competes with no one, no one can compete with her. --}}


@push('js')
<script>
    window.livewire.on('sss', () => {
        var myModal = new bootstrap.Modal(document.getElementById("unpaid_invoice"), {});
        myModal.show();
    });

</script>
@endpush

</div>

@push('css')
{{--
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endpush
<section class="main-section users">
    <!-- @if ($errors->any())
    @foreach ($errors->all() as $error)
<div class="alert alert-warning">{{ $error }}</div>
@endforeach
    @endif -->
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('admin.View patient') }}</h4>
        <div class="section-content bg-white rounded-3 shadow p-4">
            <div class="row row-gap-24">
                <div class="col-lg-3">
                    <div class="list-group main-list-group">
                        <button wire:click='$set("screen","data")' type="button" class="list-group-item list-group-item-action {{ $screen == 'data' ? 'active' : '' }}">
                            {{ __('admin.Patient data') }}
                        </button>
                        <button wire:click='$set("screen","invoices")' type="button" class="list-group-item list-group-item-action {{ $screen == 'invoices' ? 'active' : '' }}">
                            {{ __('admin.All_bills') }}
                            <div class="badge-count">
                                {{ $patient->invoices()->count() }}
                            </div>
                        </button>
                        <button wire:click='$set("screen","appointments")' type="button" class="list-group-item list-group-item-action {{ $screen == 'appointments' ? 'active' : '' }}">
                            {{__('admin.All_appointments') }}
                            <div class="badge-count">
                                {{ $patient->appointments()->count() }}
                            </div>
                        </button>
                        <button wire:click='$set("screen","diagnoses")' type="button" class="list-group-item list-group-item-action {{ $screen == 'diagnoses' ? 'active' : '' }}">
                            {{ __('admin.Medical_diagnoses') }}
                            <div class="badge-count">
                                {{ $patient->diagnoses()->count() }}
                            </div>
                        </button>
                        <button wire:click='$set("screen","vaccination")' type="button" class="list-group-item list-group-item-action {{ $screen == 'vaccination' ? 'active' : '' }}">
                            {{ __('Vaccinations') }}
                            <div class="badge-count">
                                {{ $vaccines->count() }}
                            </div>
                        </button>
                        <button wire:click='$set("screen","files")' type="button" class="list-group-item list-group-item-action {{ $screen == 'files' ? 'active' : '' }}">
                            {{ __('admin.attached_files') }}
                            <div class="badge-count">
                                {{ $patient->files()->count() }}
                            </div>
                        </button>
                        @can('read_scan_requests_patients')
                        <button wire:click='$set("screen","scans")' type="button" class="list-group-item list-group-item-action {{ $screen == 'scans' ? 'active' : '' }}">
                            {{ __('Radiology Requests') }}
                            <div class="badge-count">
                                {{ $patient->scanRequests()->count() }}
                            </div>
                        </button>
                        @endcan
                        @can('read_lab_requests_patients')
                        <button wire:click='$set("screen","labs")' type="button" class="list-group-item list-group-item-action {{ $screen == 'labs' ? 'active' : '' }}">
                            {{ __('Lap Requests') }}
                            <div class="badge-count">
                                {{ $patient->analyses()->count() }}
                            </div>
                        </button>
                        @endcan
                        <button wire:click='$set("screen","points")' type="button" class="list-group-item list-group-item-action {{ $screen == 'points' ? 'active' : '' }}">
                            {{ __('admin.loyalty_points') }}
                            <div class="badge-count">
                                {{ $patient->offerLogs()->count() }}
                            </div>
                        </button>
                        <button wire:click='$set("screen","prescriptions")' type="button" class="list-group-item list-group-item-action {{ $screen == 'points' ? 'active' : '' }}">
                            الوصفات
                            <div class="badge-count">
                                {{ $prescriptions->count() }}
                            </div>
                        </button>
                        @can('check_phone_patients')
                        <button wire:click='$set("screen","contact")' type="button" class="list-group-item list-group-item-action {{ $screen == 'contact' ? 'active' : '' }}">
                            {{ __('Contact data') }}
                        </button>
                        @endcan
                    </div>
                </div>

                <div class="col-lg-9">

                    @include('front.patients.show-screens.' . $screen)
                    <div class="row">
                        <div class="col-4">
                            {{ __('Number') }}:
                            <span class="text-main-color">{{ $patient->id }}</span>
                        </div>
                        <div class="col-4">
                            {{ __('admin.employee') }}:
                            <span class="text-main-color">{{ $patient->user?->name }}</span>
                        </div>
                        <div class="col-4">
                            {{ __('Latest employee update:') }}
                            <span class="text-main-color">{{ $patient->user?->name }}</span>
                        </div>
                    </div>
                    <div class="btn_holder d-flex align-items-center justify-content-center my-3">
                        <a href="{{ route('front.patientFile', $patient->id) }}" class="btn btn-sm btn-purple">
                            <i class="fa fa-eye"></i>
                            {{ __('View the patient is medical file')}}
                        </a>
                    </div>
                </div>


            </div>
        </div>
    </div>

</section>

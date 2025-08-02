<div class="dr-main-section">
    <div class="container">
        <h4 class="main-heading mb-4">{{ __('admin.home') }}</h4>

        <ul class="nav nav-pills main-nav-tap mb-3 not-print" style="flex-wrap: wrap !important;">
            <li class="nav-item">
                <a href="#" wire:click="$set('screen','latest')" class="nav-link {{ $screen == 'latest' ? 'active' : '' }}">
                    {{ __('Latest statistics') }}
                </a>
            </li>
            @can('show_statistics_doctor')
            <li class="nav-item">
                <a href="#" wire:click="$set('screen','doctors')" class="d-flex align-items-center gap-2 nav-link {{ $screen == 'doctors' ? 'active' : '' }}">
                    {{ __('Doctors statistics') }}
                    <div class="badge-new">
                        {{ __('New') }}
                    </div>
                </a>
            </li>
            @endcan
        </ul>

        @if ($screen == 'latest')
        <div class=" main-tab-content border-0 pt-3 px-2 pb-0">
            <h4 class="main-heading mb-3">{{ __('admin.home') }}</h4>
            <h4 class="small-heading mb-2">{{ __('admin.statistics') }}</h4>
            <div class="boxes-info-5 mb-4">
                <a href="{{ route('doctor.appointments',['app_day' => 'today']) }}" class="box-info green">
                    <i class="far fa-calendar-alt bg-icon"></i>
                    <div class="num">{{ doctor()->appointments()->today()->count() }}</div>
                    <div class="text">{{ __('Today appointments') }}</div>
                </a>
                <a href="{{ route('doctor.invoices.index') }}" class="box-info red">
                    <i class="fas fa-file-invoice-dollar bg-icon"></i>
                    <div class="num">{{ doctor()->invoices()->count() }}</div>
                    <div class="text">{{ __('All Invoices') }}</div>
                </a>
                <a href="{{ route('doctor.invoices.index',['status' => 'unpaid']) }}" class="box-info orange">
                    <i class="fas fa-file-invoice bg-icon"></i>
                    <div class="num">{{ doctor()->invoices()->unpaid()->count() }}</div>
                    <div class="text">{{ __('Unpaid bills') }}</div>
                </a>
            </div>
            <h4 class="small-heading mb-3">{{ __('Today appointments') }}</h4>
            <div class="tabla-content p-3 rounded-2 shadow bg-white">
                <div class="table-responsive">
                    <table class="table main-table mb-1">
                        <thead>
                            <th>{{ __('admin.patient') }}</th>
                            <th>{{ __('admin.appointment_status') }}</th>
                            <th>{{ __('admin.appointment_time') }}</th>
                            <th>{{ __('admin.appointment_date') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </thead>
                        <tbody>
                            @forelse ($appoints as $appoint)
                            <tr>
                                <td>{{ $appoint->patient?->name }}</td>
                                <td>{{ __($appoint->appointment_status) }}</td>
                                <td>{{ $appoint->appointment_time }}</td>
                                <td>{{ $appoint->appointment_date }}</td>
                                <td>
                                    @if ($appoint->appointment_status == 'pending')
                                    <button class="btn btn-sm btn-info" wire:click="cancel({{ $appoint->id }})">الغاء</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12">{{ __('admin.Sorry, there are no results') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @elseif($screen == 'doctors')
        @can('show_statistics_doctor')
        <div class="main-tab-content border-0 pt-3 px-2 pb-0">
            <h4 class="small-heading mb-3">{{ __('Doctors statistics') }}</h4>
            <div class="row mb-5">
                <div class="col-md-4 d-flex gap-3">
                    <input type="date" wire:model="from" class="form-control" id="from">
                    <input type="date" wire:model="to" class="form-control" id="to">
                </div>
            </div>
            <div class="row g-3 mb-4 boxes-info">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center p-0">
                            <h5 class="option-name mb-0 xl text-white p-2 alt2-bg-color">{{ $doctor->name }}
                            </h5>
                            <div class="p-3">
                                <h6><span class="text-danger">القسم : </span>{{ $doctor->department?->name }}
                                </h6>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <p><strong class="text-primary">مواعيد اليوم : </strong>
                                            {{ $doctor->appointments()->today()->count() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-warning">صالة الإنتظار : </strong>
                                            {{ $doctor->appointments()->today()->where(function ($qu) {
                                                            $qu->where('appointment_status', 'confirmed')->orWhere('appointment_status', 'transferred');
                                                        })->count() }}
                                        </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-gray">مواعيد المراجعة : </strong>
                                            {{ $doctor->appointments->where('review', 1)->count() }} </p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong class="text-danger">تم الكشف : </strong>
                                            {{ $doctor->appointments->where('appointment_status', 'examined')->count() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan
        @endif
    </div>
</div>

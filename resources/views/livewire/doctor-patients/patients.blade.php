<section class="">

    <div class="container">
        <h4 class="main-heading">{{ __('admin.patients') }}</h4>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="amountPatients-holder d-flex flex-column flex-md-row justify-content-start gap-2">
                <div class="info-data">
                    {{ __('Saudi patients') }} : {{ App\Models\Patient::count() }}
                </div>
                {{-- <div class="info-data">
                    {{ __('Non-Saudi patients')}} : {{ App\Models\Patient::where('country_id','<>',1)->count() }}
            </div>
            <div class="info-data">
                {{ __('Registered guest')}} : {{ App\Models\Patient::where('visitor',1)->count() }}
            </div> --}}
            </div>

            <div class="row my-3">
                <div class="col-md-10 d-flex flex-column flex-md-row">
                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('admin.Search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model='civil'
                            wire:change='resetPage' placeholder=" {{ __('admin.ID number search') }}" />
                    </div>

                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('admin.Search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model='phone'
                            wire:change='resetPage' placeholder="{{ __('admin.Mobile number search') }}" />
                    </div>

                    <div dir="ltr" class="input-group ms-2 mb-2 mb-md-0">
                        <button id="button-addon2" type="button" class="btn btn-success input-group-addon">
                            {{ __('admin.Search') }}
                        </button>
                        <input dir="rtl" type="text" class="form-control" wire:model='patient_id'
                            wire:change='resetPage' placeholder="  {{ __('admin.Search by medical number') }}" />
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <div class="addBtn-holder ">
                        <a href="{{ route('front.patients.create') }}" class="btn-main-sm">
                            {{ __('admin.Add patient') }}
                            <i class="icon fa-solid fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="prt-content" class="table main-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.Medical number') }} </th>
                            <th>{{ __('admin.name') }}</th>
                            @can('check_phone_patients')
                                <th>{{ __('admin.phone') }}</th>
                            @endcan
                            {{-- <th>{{ __('Unpaid bills') }}</th> --}}
                            {{-- <th>{{ __('admin.Last modified by') }}</th> --}}
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->id }}</td>
                                <td class="text-nowrap">{{ $patient->name }}</td>
                                @can('check_phone_patients')
                                    <td>{{ $patient->phone }}</td>
                                @endcan
                                {{-- <td>
                                    <a href="{{ route('front.invoices.index', ['patient_id' => $patient->id, 'status' => 'Unpaid']) }}"
                        class="btn btn-sm btn-outline-secondary">
                        {{ $patient->invoices()->unpaid()->count() }}
                        </a>
                        </td> --}}
                                {{-- <td>{{ $patient->user->name }}</td> --}}
                                {{-- <td>
                                    <!--btn  Modal repeat-->
                                    <button type="button" wire:click="addToQueue({{ $patient }})"
                        class="btn btn-sm btn-secondary text-nowrap">
                        @if ($patient->inQueue())
                        {{ __('Delete from Queue') }}
                        @else
                        {{ __('Add to Queue') }}
                        @endif
                        </button>
                        </td> --}}
                                <td class="not-print">
                                    <div class="d-flex align-items-center justify-content-center gap-1">
                                        <!-- <button class="btn btn-warning btn-sm "><i class="fa-solid fa-hourglass-half"></i></button> -->
                                        <a href="{{ route('front.patients.animals', $patient) }}"
                                            class="btn btn-sm btn-dark text-white">
                                            <i class="fa-solid fa-hippo"></i>
                                            {{ $patient->animals->count() }}
                                        </a>
                                        <a href="{{ route('doctor.patients.show', $patient) }}"
                                            class="btn btn-sm btn-purple">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{-- @can('تحويل مريض')
                                            <button type="button" wire:click="transfer({{ $patient }})"
                                class="btn btn-sm btn-primary">
                                <i class="fa fa-repeat"></i>
                                </button>
                                @endcan --}}
                                        @can('update_patients')
                                            <a href="{{ route('front.patients.edit', $patient) }}"
                                                class="btn btn-sm btn-info text-white">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        @endcan
                                        @can('delete_patients')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $patient->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @include('front.patients.delete')
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- All Modal -->
            <!-- Modal repeat -->
            <div class="pagination justify-content-center">
                {{ $patients->links() }}
            </div>
        </div>
    </div>
</section>

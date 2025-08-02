<section class="main-section users">
    <x-alert></x-alert>
    <div class="container" id="data-table">
        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.Registered patients') }}</h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div
                class="amountPatients-holder gap-2 d-flex align-items-start align-items-md-center justify-content-between flex-column flex-xl-row">
                <div class="d-flex align-items-center gap-1 flex-wrap">
                    <div class="info-data" style="cursor: pointer" wire:click='$set("filter_visit",false)'>
                        {{-- {{ __('Saudi patients') }} : {{ App\Models\Patient::where('country_id', 1)->count() }} --}}
                        {{ __('Saudi patients') }} : {{ App\Models\Patient::count() }}

                    </div>
                    <div class="info-data" style="cursor: pointer" wire:click='$toggle("filter_visit")'>
                        {{ __('Registered Visitor') }} : {{ App\Models\Patient::where('visitor', 1)->count() }}
                    </div>
                </div>
                <div class="btn-holders d-flex align-items-center gap-1 flex-wrap">
                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-circle"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip fs-10px"
                        data-bs-title="{{ __('Visitor registrars are those who have made reservations over the phone or via the website and their data is completed when they attend the clinic') }}">
                        <i class="fa-solid fa-question"></i>
                    </button>
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <a class="sec-btn-gre" href="{{ route('front.export.patients') }}">
                        {{ __('admin.Export registered patients') }}
                        <i class="fa-solid fa-hospital-user"></i>
                    </a>
                    {{-- <a class="sec-btn-gre" href="{{ route('front.patients.export') }}">
                    {{ __('admin.Export registered patients') }}
                    <i class="fa-solid fa-hospital-user"></i>
                    </a> --}}
                    <a class="btn btn-sm btn-outline-primary rounded-0" href="{{ route('front.patients.export') }}">
                        {{ __('admin.Export') }} Excel
                        <i class="fa-solid fa-file-import"></i>
                    </a>
                </div>
            </div>

            <div class="">
                <div class="row my-3 g-2">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-10 d-flex flex-column flex-lg-row gap-2 px-0">

                        <input dir="rtl" type="text" wire:model.live="number_sim" class="form-control"
                            placeholder="{{ __('Search by chip number') }}" />

                        <input dir="rtl" type="text" class="form-control" wire:change='resetPage'
                            wire:model='phone' placeholder="{{ __('admin.Mobile number search') }}" />

                        <input dir="rtl" type="text" class="form-control" wire:change='resetPage'
                            wire:model='patient_id' placeholder="  {{ __('admin.Search by medical number') }}" />
                        <input dir="rtl" type="text" class="form-control" wire:model='patient_name'
                            placeholder="  {{ __('admin.Search by name') }}" />
                    </div>
                    @can('create_patients')
                        <div class="col-12 col-sm-12 col-lg-2 d-flex align-items-center justify-content-end px-0">
                            <div class="addBtn-holder ">
                                <a href="{{ route('front.patients.create') }}" class="btn-main-sm">
                                    {{ __('admin.Add patient') }}
                                    <i class="icon fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    @endcan
                </div>
                <div id="prt-content" class="table-print">
                    <x-header-invoice></x-header-invoice>
                    <div class="table-responsive">
                        <table class="table main-table">
                            <thead>
                                <tr>
                                    <th>{{ __('admin.Medical number') }} </th>
                                    <th>{{ __('admin.name') }}</th>
                                    @can('check_phone_patients')
                                        <th>{{ __('admin.phone') }}</th>
                                    @endcan
                                    <th>{{ __('Last Visit') }}</th>
                                    <th>{{ __('city') }}</th>
                                    <th>{{ __('date of registration') }}</th>
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
                                        <td>{{ $patient->last_visit }}</td>
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
                                        <td>{{ $patient->city?->name ?? '--' }}</td>
                                        <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                                        <td class="not-print">
                                            <div class="d-flex align-items-center justify-content-center gap-1">
                                                <!-- <button class="btn btn-warning btn-sm "><i class="fa-solid fa-hourglass-half"></i></button> -->
                                                <a href="https://wa.me/966{{ $patient->phone }}"
                                                    class="btn btn-sm btn-success py-1" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="{{ __('Whatsapp') }}"
                                                    data-bs-custom-class="fit-tooltip">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                </a>
                                                <a href="{{ route('front.patients.animals', $patient->id) }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="fit-tooltip"
                                                    data-bs-title="{{ __('Owner Patient') }}"
                                                    class="btn btn-sm btn-dark text-white">
                                                    <i class="fa-solid fa-hippo"></i>
                                                    {{ $patient->animals_count }}
                                                </a>

                                                <a href="{{ route('front.invoices.create', ['patient_id' => $patient->id]) }}"
                                                    class="btn btn-sm btn-success" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="fit-tooltip"
                                                    data-bs-title="{{ __('Add invoice') }}">
                                                    <i class="fa-solid fa-file-invoice-dollar"></i>
                                                </a>

                                                <a href="{{ route('front.patients.show', $patient->id) }}"
                                                    class="btn btn-sm btn-purple" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-custom-class="fit-tooltip"
                                                    data-bs-title="{{ __('Patient File') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>

                                                <div class="dropdown drop-table">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @can('update_patients')
                                                            <li>
                                                                <a class="dropdown-item text-center"
                                                                    href="{{ route('front.patients.edit', $patient) }}">
                                                                    <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                                    {{ __('update') }}
                                                                </a>
                                                            </li>
                                                        @endcan
                                                        @can('delete_patients')
                                                            <li>
                                                                <button class="dropdown-item text-center text-danger"
                                                                    data-bs-toggle="modal" data-bs-placement="top"
                                                                    data-bs-title="{{ __('delete') }}"
                                                                    data-bs-target="#delete_agent{{ $patient->id }}">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                    {{ __('delete') }}
                                                                </button>
                                                            </li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('front.patients.delete')
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $patients->links() }}
                <!-- All Modal -->
                <!-- Modal repeat -->
            </div>
        </div>
        @include('front.patients.transfer')
        @push('js')
            <script>
                window.livewire.on('trans_modal', function() {
                    var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
                    myModal.show();
                })
            </script>
        @endpush



</section>

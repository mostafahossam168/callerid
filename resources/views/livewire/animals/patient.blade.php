<section class="main-section users">
    <x-alert></x-alert>
    @if ($screen == 'index')
    <div class="container" id="data-table">

        <div class="d-flex align-items-center gap-4 felx-wrap justify-content-between mb-3">
            <h4 class="main-heading mb-0">{{ __("admin.Owner's animals") }}
                {{ $patient->name ?? null }}
            </h4>
        </div>
        <div class="bg-white shadow p-4 rounded-3">
            <div class="alert alert-primary" role="alert">
                <p class="mb-0">
                    {{ __("admin.You can refer all of the owner's animals at once to the doctor") }}
                </p>
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap mb-2">
                <div class="info-holder d-flex align-items-center gap-1">
                    <div class="info-data">{{ __('admin.Owner file number') }} : {{ $patient->id ?? null }}</div>
                    <div class="info-data"> {{ __('admin.Owner name') }} : {{ $patient->name ?? null }}</div>
                    <div class="info-data">{{ __('admin.Mobile_number') }} : {{ $patient->phone ?? null }}</div>
                </div>
                <div class="buttons-holder gap-1 d-flex align-items-center flex-wrap">
                    @if (count($selectedItems) > 0)
                    <button data-bs-toggle="modal" data-bs-target="#transfer_all" class="btn-sm btn-primary" wire:click="getTransferedAnimals">
                        {{ __('admin.transfer_all') }}
                        <i class="fa fa-repeat"></i>
                    </button>
                    @endif
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning py-1">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button wire:click="$set('screen','add')" class="btn-main-sm">
                        {{ __('admin.Add') }}
                        <i class="icon fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive overflow-visible">
                <x-header-invoice/>
                <table id="prt-content" class="table main-table">
                    <thead>
                        <tr>
                            <th class="not-print"></th>
                            <th>{{ __('admin.Pet number') }}</th>
                            <th>{{ __('admin.Pet name') }}</th>
                            <th>{{ __('admin.Type') }}</th>
                            <th>{{ __('admin.Pet Gender') }}</th>
                            <th>{{ __('admin.Pet Age') }}</th>
                            <th>{{ __('admin.Pet strain') }}</th>
                            <th>{{ __('admin.last visit') }}</th>
                            <th></th>
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($animals as $animal)
                        <tr>
                            <td class="not-print">
                                <input type="checkbox" wire:click="toggleItem({{ $animal->id }})" value="{{ $animal->id }}" @if (in_array($animal->id, $selectedItems)) checked @endif />
                            </td>
                            <td>{{ $animal->id }}</td>
                            <td class="text-nowrap">{{ $animal->name }}</td>
                            <td>{{ $animal->category->name ?? '-' }}</td>
                            <td>{{ __($animal->gender) }}</td>
                            <td>{{ $animal->age }}</td>
                            <td>{{ $animal->strain->name ?? '-' }}</td>
                            <td>{{ $animal->last_visit }}</td>

                            <td class="not-print">
                                <!--btn  Modal repeat-->
                                <button type="button"
                                        wire:click="addToQueue({{ $animal->patient }},{{ $animal->id }})"
                                        class="btn btn-sm btn-secondary text-nowrap">
                                    @if (App\Models\Queue::where('patient_id', $animal->patient->id)->where('animal_id', $animal->id)->first())
                                        {{ __('Delete from Queue') }}
                                    @else
                                        {{ __('Add to Queue') }}
                                    @endif

                                </button>
                            </td>

                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="{{ route('front.animals.show', $animal) }}" class="btn btn-sm btn-purple">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <button type="button" wire:click="transfer({{ $animal }})" class="btn btn-sm btn-primary">
                                        <i class="fa fa-repeat"></i>
                                    </button>
                                    <!-- <a href="{{ route('front.animals.edit', $animal) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $animal->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button> -->
                                    <div class="dropdown drop-table">
                                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item text-center" href="{{ route('front.animals.edit', $animal) }}">
                                                    <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                    تعديل
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item text-center text-danger"  data-bs-toggle="modal" data-bs-target="#delete_agent{{ $animal->id }}" data-bs-placement="top" data-bs-title="حذف">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    حذف
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('front.animals.delete')
                        {{-- @include('front.patients.delete') --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    @include('front.animals.add-or-edit')
    @endif
    @include('front.animals.transfer')
    @include('front.animals.transfer_all')
    @push('js')
    <script>
        window.livewire.on('trans_modal', function() {
            var myModal = new bootstrap.Modal(document.getElementById("trans"), {});
            myModal.show();
        })
    </script>
    @endpush



</section>

<section class="main-section notice">
    <x-alert></x-alert>
    <div class="container">
        <h4 class="main-heading">{{ __('Queue') }}</h4>
        <div class="bg-white p-3 rounded-2 shadow not-print">
            <div class="alert alert-info">
                {{ __('admin.queue_message') }}
            </div>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                <div class="status-holder d-flex align-items-center  flex-wrap  gap-2">
                    <div class=" bg-secondary px-3 py-2 rounded-3 text-white">
                        {{ __('admin.The number of patients in the waiting room') }}
                        : {{ $queue->count() }}
                    </div>
                    <div class=" bg-secondary px-3 py-2 rounded-3 text-white">
                        {{ __('admin.Number of patients waiting today') }} : {{ $todayQueue->count() }}
                    </div>
                </div>
                <!-- // add to queue modal -->
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm py-1" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    {{ __('Add to Queue') }}
                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('Add to Queue') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control" wire:model.defer="patient_key"
                                placeholder="بحث برقم ملف المريض او رقم الجوال">
                                <button class="btn btn-sm btn-info" wire:click="get_patient">بحث</button>
                            @if($patient)
                            <select wire:model="animal_id" id="animal_id" class="form-control">
                                <option value="">اختر الحيوان</option>
                                @foreach ($animals as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                                @endforeach
                            </select>
                            @endif

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('close')
                                }}</button>
                            <button type="button" class="btn btn-primary" wire:click="addToQueue">{{ __('Add')
                                }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- // end add to queue modal -->
            @forelse($queue as $q)
            <div class="p-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                <!-- queue order -->
                <div class="d-flex align-items-center gap-2" id="prt-content">
                    <span class="badge bg-primary">{{ $loop->iteration }}</span>
                    <a href="{{ route('front.patients.show', $q->patient->id) }}" class="link-one">
                        {{ $q->patient?->name }} - {{ $q->animal?->name }} - {{ \Carbon\Carbon::parse($q->created_at)->isoFormat('LLLLA') }}
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    @can('transfer_patients')
                    <button type="button" wire:click="transfer({{ $q->patient }},{{ $q }})" class="btn-main-sm">
                        {{__('admin.transfer')}}
                        <i class="fa fa-repeat"></i>
                    </button>
                    @endcan
                    <button class="btn btn-sm btn-danger" wire:click="delete({{ $q->id }})">{{ __('Delete from Queue')
                        }}</button>
                    <button class="btn btn-sm btn-warning" id="btn-prt-content"><i
                            class="fa-solid fa-print"></i></button>
                </div>
            </div>
            <hr class="w-75 mx-auto my-1">
            @empty
            <div class="p-3 border-bottom">
                {{ __('Queue is empty') }}
            </div>
            @endforelse
        </div>
        {{-- <div class="bg-white p-3 rounded-3 mt-4 info-pas" id="prt-content">
            <div class="row">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-holder">
                        <span>
                            {{__('admin.name')}}: محمد محمد محمد
                        </span>
                    </div>
                    <div class="text-holder">
                        <span>
                            رقم الملف الطبي: 1
                        </span>
                    </div>
                    <div class="text-holder">
                        <span>
                            رقم الانتظار: 2
                        </span>
                    </div>
                </div>
            </div>
        </div> --}}
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

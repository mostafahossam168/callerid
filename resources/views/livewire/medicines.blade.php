<section class="main-section ">
    <div class="container">
        @if ($screen == 'index')
            <h4 class="main-heading mb-4">{{ __('admin.medicines') }}</h4>
            <div class="section-content bg-white rounded-3 p-4 shadow">

                <form action=""
                    class="right-holder d-flex flex-wrap flex-sm-nowrap flex-sm-row align-items-center mb-2 mb-lg-0 justify-content-center">
                    <div class="duration-from d-flex align-items-center justify-content-center me-2">
                        <label for="date-from" class="fild-name ms-2">{{ __('admin.from') }}</label>
                        <input type="date" class="date-from form-control mb-2 mb-sm-0" id="date-from"
                            wire:model="from" />
                    </div>
                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <label for="date-to" class="fild-name ms-2">{{ __('admin.To') }}</label>
                        <input type="date" class="date-to form-control mb-3 mb-sm-0" id="date-to"
                            wire:model="to" />
                    </div>

                    <div class="duration-to d-flex align-items-center justify-content-center me-2">
                        <input type="text" class="date-to form-control mb-3 mb-sm-0" wire:model="search"
                            placeholder="بحث باسم الدواء" />
                    </div>


                </form>

                <div class="btn-holder-option d-flex align-items-center flex-wrap gap-2 justify-content-between mb-2">
                    <button class="btn btn-success btn-sm" wire:click='$set("screen","create")'>
                        {{ __('admin.Add medicine') }}
                    </button>
                    <div class="nes-holder d-flex gap-2">
                        <button class="btn btn-sm btn-outline-primary" wire:click='$set("screen","import")'>
                            {{ __('admin.import_from_excel') }}
                            <i class="fa-solid fa-file-excel"></i>
                        </button>
                        <a class="btn  btn-sm btn-outline-primary" href="{{ route('front.medicines.export') }}">
                            {{ __('admin.Export') }}
                            <i class="fa-solid fa-file-import"></i>
                        </a>
                        <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table main-table" id="prt-content">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('admin.name_ar') }}</th>
                                <th>{{ __('admin.name_en') }}</th>
                                <th>{{ __('admin.cost_price') }}</th>
                                <th>{{ __('admin.selling_price') }}</th>
                                <th>{{ __('admin.selling_price_with_tax') }}</th>
                                <th>{{ __('admin.num_of_paid') }}</th>
                                <th class="text-center not-print">{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($medicines as $medicine)
                                @php
                                    $num_of_paid = $ids->where('id', $medicine->id)->sum('quantity');
                                @endphp
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $medicine->name_ar }}</td>
                                    <td>{{ $medicine->name_en }}</td>
                                    <td>{{ $medicine->cost_price }}</td>
                                    <td>{{ $medicine->selling_price }}</td>
                                    <td>{{ $medicine->selling_price_with_tax }}</td>
                                    <td>{{ $num_of_paid }}</td>
                                    <td class="not-print">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            {{-- <a href="{{ route('front.medicines_report', ['medicine' => $medicine->id]) }}"
                                                class="btn btn-sm trans-btn text-white">{{ __('admin.financial report') }}</a> --}}
                                            <button wire:click='edit({{ $medicine }})'
                                                class="btn btn-sm btn-info text-white">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete_agent{{ $medicine->id }}">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @include('front.medicines.delete')
                            @endforeach
                        </tbody>
                    </table>
                    {{ $medicines->links() }}
                </div>
            </div>
        @elseif($screen == 'import')
            @include('front.medicines.import')
        @else
            @include('front.medicines.add_or_edit')
        @endif
    </div>
</section>

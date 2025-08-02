<section class="main-section users">

    <x-alert></x-alert>
    @include('front.supplies.modal')

    @include('front.supplies.quantity_in_modal')
    @include('front.supplies.quantity_out_modal')

    <div class="container-fluid">
        <h4 class="main-heading">@lang('kinds')</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 mb-3 justify-content-between">
                <div class="status d-flex flex-wrap gap-1">
                    <div class="py-2 px-3 bg-info rounded text-white">
                        كل الاصناف : {{ \App\Models\Supply::count() }}
                    </div>
                    <div class="py-2 px-3 bg-success rounded text-white">
                        الاصناف متوفرة :
                        {{ \App\Models\Supply::where('quantity', '>', 0)->count() }}
                    </div>
                    <div class="py-2 px-3 bg-danger rounded text-white">
                        الاصناف الغير متوفرة :
                        {{ \App\Models\Supply::where('quantity', '<', 1)->count() }}
                    </div>

                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-purple btn-sm px-4" wire:click='export'>
                        {{ __('admin.Export') }}
                        <i class="fas fa-file-csv"></i>
                    </button>
                    <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('admin.Add') }}
                        <i class="fas fa-plus"></i>
                    </button>
                    <a type="button" class="btn btn-sm  btn-secondary" href="{{ route('front.kinds') }}">
                        مستودع العيادة
                        <i class="fas fa-arrow-left-long"></i>
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الضنف</th>
                            <th scope="col">{{ __('admin.Main category') }}</th>
                            <th scope="col">{{ __('admin.Subcategory') }}</th>
                            <th scope="col">{{ __('admin.open_quantity') }}</th>
                            <th scope="col">{{ __('admin.current_quantity') }}</th>
                            <th scope="col">{{ __('admin.cost_price') }}</th>
                            {{-- <th scope="col">{{ __('admin.selling_price') }}</th> --}}
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplies as $supply)
                        @php
                        $paid_quantity = \App\Models\Purchase::where('supply_id', $supply->id)->sum('qty');
                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $supply->name }}</td>
                            <td>{{ $supply->kind?->name ?? '-' }}</td>
                            <td>{{ $supply->kind->main?->name ?? '-' }}</td>
                            <td>{{ $supply->open_quantity }}</td>
                            <td>{{ $supply->quantity }}</td>
                            <td>{{ $supply->purchase_price }}</td>
                            {{-- <td>{{ $supply->selling_price }}</td> --}}
                            <td>
                                <div class="d-flex gap-2 flex-wrap ">
                                    <!-- <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $supply->id }})">
                                        {{ __('admin.Update') }}
                                    </button> -->


                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#quantityIn" wire:click="updateQuantity({{ $supply->id }})">
                                        {{ __('admin.Add quantity') }}
                                    </button>

                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#quantityOut" wire:click="updateQuantity({{ $supply->id }})">
                                        {{ __('admin.Disbursement amount') }}
                                    </button>

                                    <a href="{{ route('front.supplies.show', $supply->id) }}" class="btn btn-sm btn-secondary">
                                        {{ __('admin.Inventory Movement') }}
                                    </a>

                                    <!-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete{{ $supply->id }}">
                                        {{ __('admin.Delete') }}
                                    </button> -->
                                    <div class="dropdown drop-table">
                                        <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('update_patients')
                                            <li>
                                                <button class="dropdown-item text-center" data-bs-toggle="modal" data-bs-target="#exampleModal" wire:click="edit({{ $supply->id }})">
                                                    <i class="fa-solid fa-pen-to-square text-dark"></i>
                                                    تعديل
                                                </button>
                                            </li>
                                            @endcan
                                            @can('delete_patients')
                                            <li>
                                                <button class="dropdown-item text-center text-danger" data-bs-toggle="modal" data-bs-placement="top" data-bs-title="حذف" data-bs-target="#delete{{ $supply->id }}">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                    حذف
                                                </button>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                                @include('front.supplies.delete')

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $supplies->links() }}
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->
    </div>
</section>

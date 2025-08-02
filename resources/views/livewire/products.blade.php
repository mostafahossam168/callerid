<section class="main-section users">
    <x-alert></x-alert>
    @include('front.products.add_or_update')
    <div class="container">
        <h4 class="main-heading">{{ __('admin.items') }} <small class="text-danger fs-12px">{{ __('admin.All prices here include tax in the event of an automatic sale') }}</small>
        </h4>

        <div class="bg-white rounded-3 shadow p-3">
            <div class="d-flex align-items-center flex-wrap gap-2 mt-2 justify-content-between mb-2">
                <div class="d-flex align-items-center gap-1">
                    <div class="d-flex gap-2">
                        <select class="main-select " wire:model="filter_by_department" id="">
                            <option value="">{{ __('admin.Choose the department') }}</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control" wire:model="key" placeholder="{{ __('admin.Search by name') }}">
                    </div>
                </div>

                <div class="btn-holder-option d-flex gap-1">
                    @can('create_products')
                    <button class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#add_or_update">
                        {{ __('admin.Add product') }}
                        <i class="icon fa-solid fa-plus me-1"></i>
                    </button>
                    @endcan
                    <button id="btn-prt-content" class="print-btn btn btn-sm btn-warning">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    <button class="btn  btn-sm btn-outline-primary" wire:click="export">
                        {{ __('admin.Export') }}
                        <i class="fa-solid fa-file-import"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm px-3" data-bs-toggle="modal" data-bs-target="#bulkdelete" id="btn_delete_all">
                        {{ __('admin.Delete all') }}
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table" id="prt-content">
                    <thead>
                        <tr>
                            <th class="not-print"> <input type="checkbox" name="select_all" id="select-all"> </th>
                            <th>{{ __('service number') }}</th>
                            <th>{{ __('admin.name') }}</th>
                            <th>{{ __('admin.department') }}</th>
                            <th>{{ __('admin.price') }}</th>
                            <th>{{ __('admin.max_discount_rate') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th class="text-center not-print">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <th class="not-print">
                                <div class="animated-checkbox">
                                    <label class="m-0">
                                        <input type="checkbox" value="{{ $product->id }}" name="delete_select" id="delete_select">
                                        <span class="label-text"></span>
                                    </label>
                                </div>
                            </th>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->department->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->discount_rate }} %</td>
                            <td>{{ $product->tax_enabled ? 'مفعل' : 'غير مفعل' }}</td>
                            <td class="not-print">
                                <div class="d-flex align-items-center justify-content-center gap-1">
                                    <a href="{{ route('front.products_report', ['product' => $product->id]) }}" class="btn btn-sm trans-btn text-white space-noWrap">{{ __('admin.financial report') }}</a>
                                    <button data-bs-toggle="modal" data-bs-target="#add_or_update" class="btn btn-sm btn-info text-white" wire:click='edit({{ $product }})'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    @can('delete_products')
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $product->id }}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    @endcan
                                    {{-- modal bulk delete --}}

                                    <form class="my-1 my-xl-0" action="{{ route('front.products.bulk_delete', 'ids') }}" method="post" style="display: inline-block;" autocomplete="off">
                                        @csrf
                                        @method('delete')
                                        <div class="modal fade" id="bulkdelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                            {{ __('admin.Delete all') }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ __('admin.Do you want to clear all treatment services?') }}
                                                        <input type="hidden" id="delete_all" name="delete_select_id" value="">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.Close') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('admin.Yes') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    {{-- End modal bulk delete --}}
                                </div>
                            </td>
                        </tr>
                        @include('front.products.delete')
                        @endforeach

                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>

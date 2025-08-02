<section class="main-section users">

    <x-alert></x-alert>
    @include('front.suppliers.modal')

    <div class="container">
        <h4 class="main-heading">{{ __('admin.suppliers') }}</h4>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-between mb-3">
                @can('create_suppliers')
                    <button type="button" class="btn-main-sm px-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('admin.Add') }}
                    </button>
                @endcan
            </div>

            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">{{ __('admin.address') }}</th>
                            <th scope="col">{{ __('admin.tax_no') }}</th>
                            <th scope="col">{{ __('admin.phone') }}</th>
                            <th scope="col">{{ __('Warehouse') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ $supplier->tax_no }}</td>
                                <td>{{ $supplier->phone }}</td>
                                <td>{{ $supplier->warehouse?->name }}</td>
                                <td>
                                    @can('update_suppliers')
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" wire:click="edit({{ $supplier->id }})">
                                            {{ __('admin.Update') }}
                                        </button>
                                    @endcan

                                    @can('delete_suppliers')
                                        @if ($supplier->vouchers() == 0)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $supplier->id }}">
                                                {{ __('admin.Delete') }}
                                            </button>
                                            @include('front.suppliers.delete')
                                        @endif
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
</section>

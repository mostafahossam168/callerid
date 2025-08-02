<section class="main-section users">

    <x-alert></x-alert>
    @include('front.warehouses.modal')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="main-heading mb-0">{{ __('admin.warehouses') }}</h4>
            <div class="d-flex gap-1 flex-column flex-md-row">
                <a href="{{ route('front.orders.create') }}" class="btn-main-sm px-4">شاشة البيع</a>
                <a href="{{ route('front.items') }}" class="btn-main-sm px-4">@lang('admin.Products')</a>
                <a href="{{ route('front.item-categories') }}" class="btn-main-sm px-4">اقسام المنتجات</a>
                <a href="{{ route('front.warehouses') }}" class="btn-main-sm px-4">المستودعات</a>
            </div>
            <div></div>
        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div class="d-flex align-items-center flex-wrap gap-1 justify-content-between mb-3">
                @can('create_warehouses')
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
                            <th scope="col">{{ __('admin.sub of') }}</th>
                            <th scope="col">{{ __('admin.Products') }}</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($warehouses as $warehouse)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $warehouse->name }}</td>
                            <td>{{ $warehouse->parent?->name }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('front.items', ['warehouse_id' => $warehouse->id]) }}">
                                    {{ $warehouse->processes()->distinct('item_id')->count() }}
                                </a>
                            </td>
                            <td>
                                @can('update_warehouses')
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" wire:click="edit({{ $warehouse->id }})">
                                    {{ __('admin.Update') }}
                                </button>
                                @endcan

                                @can('delete_warehouses')
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $warehouse->id }}">
                                    {{ __('admin.Delete') }}
                                </button>
                                @include('front.warehouses.delete')
                                @endcan

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $warehouses->links() }}
            </div>
        </div>
    </div>
</section>

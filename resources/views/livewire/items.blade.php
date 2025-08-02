<section class="main-section users">

    <x-alert></x-alert>
    @include('front.items.modal')
    @include('front.items.charge')
    @include('front.items.expense')
    @include('front.items.quantities')
    {{-- @include('front.items.transfer') --}}
    <div class="modal fade" id="stickerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@lang('Product Stickers')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center" id="sticker">
                    <div class="row g-4">
                        <div class="col-12 not-print">
                            <select wire:model='selected_item' class="main-select w-100">
                                <option value="">اختر منتج</option>
                                @foreach (App\Models\Item::get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 d-none print-block">
                            @if($barcode_selected_item?->name)
                            <input class="form-control" type="text" value="{{ $barcode_selected_item?->name }}"
                                disabled>
                            @endif
                        </div>
                        <div class="col-12">
                            <label for="" class="mb-1 d-block mb-2">باركود</label>
                            <div class="text-center d-flex justify-content-center">
                                @if($barcode_selected_item?->barcode)
                                {!! DNS1D::getBarcodeHTML($barcode_selected_item->barcode . '', 'C128') !!}
                                @else
                                <div class="alert alert-danger flex-fill">
                                    لا يوجد باركود للمنتج
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="" class="mb-1 d-block">السعر</label>

                            @if($barcode_selected_item?->sale_price)
                            <input class="form-control" type="text" value="{{ $barcode_selected_item?->sale_price }}"
                                disabled>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="model-footer d-flex justify-content-center pb-3">
                    <button onclick="printById('sticker')" class="btn btn-warning btn-sm" id="">طباعة
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="main-heading">{{ __('admin.Products') }}</h4>
            @if(auth()->user()->type != 'dr')
            <div class="d-flex gap-1 flex-column flex-md-row">
                <a href="{{ route('front.orders.create') }}" class="btn-main-sm px-4">شاشة البيع</a>
                <a href="{{ route('front.items') }}" class="btn-main-sm px-4">@lang('admin.Products')</a>
                <a href="{{ route('front.item-categories') }}" class="btn-main-sm px-4">اقسام المنتجات</a>
                <a href="{{ route('front.warehouses') }}" class="btn-main-sm px-4">@lang('Warehouse products')</a>
            </div>
            @endif
            <div></div>
        </div>
        <div class="section-content p-4 bg-white rounded-3 shadow">
            <div
                class="d-flex align-items-md-center align-items-stretch justify-content-between flex-column flex-md-row gap-3 mb-3">
                <div class=" row row-cols-1 row-cols-md-5 g-1">
                    <div class="col">
                        <select wire:model="status" class="main-select w-100">
                            <option value="">{{ __('admin.Choose the status') }}</option>
                            <option value="available">{{ __('admin.Available products') }}</option>
                            <option value="empty">{{ __('admin.Out of stock products') }}</option>
                            <option value="less_stock">{{ __('admin.Products are almost finished') }} :
                                {{ App\Models\Item::where('quantity', '<=', 5)->count() }}
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <select wire:model="warehouse_id" class="main-select w-100">
                            <option value="">{{ __('admin.warehouse') }}</option>
                            @foreach ($all_warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <select wire:model="filter_category_id" class="main-select w-100">
                            <option value="">@lang('Choose department')</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col">
                        <input class="form-control" type="text" placeholder="{{ __('admin.Barcode search') }}"
                            wire:model='barcode_search'>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" wire:model="key"
                            placeholder="{{ __('admin.Search by name') }}">
                    </div>
                </div>

            </div>

            <div class=" d-flex justify-content-between align-items-center mb-2">
                <div class="status d-flex align-items-end flex-wrap gap-1">
                    <div class="py-2 px-3 bg-info rounded text-white">
                        {{ __('admin.All products') }} : {{ \App\Models\Item::count() }}
                    </div>
                    <div class="py-2 px-3 bg-success rounded text-white">
                        {{ __('admin.Available products') }} :
                        {{ \App\Models\Item::all()->filter(function ($item) {
                        return $item->quantity > 0;
                        })->count() }}
                    </div>
                    <div class="py-2 px-3 bg-warning rounded text-white">
                        {{ __('admin.Not Available products') }} :
                        {{ \App\Models\Item::all()->filter(function ($item) {
                        return $item->quantity == 0;
                        })->count() }}
                    </div>

                </div>

                <div class="d-flex gap-1 flex-column flex-md-row">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#stickerModal">
                        @lang('Product Stickers')
                    </button>
                    @can('read_units')
                    <a href="{{ route('front.units') }}" class="btn btn-info btn-sm">
                        {{ __('admin.units') }}
                    </a>
                    @endcan
                    @can('create_items')
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#importModel">
                        {{ __('admin.Import') }}
                    </button>
                    @endcan
                    <button type="button" class="btn btn-purple btn-sm" wire:click='export'>
                        {{ __('admin.Export') }}
                    </button>
                    @can('delete_items')
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteAllModel">
                        {{ __('admin.delete_all') }}
                    </button>
                    @endcan
                    @can('create_items')
                    <button type="button" class="btn-main-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        {{ __('admin.Add') }}
                    </button>
                    @endcan
                </div>
            </div>
            <div class="table-responsive">
                <table class="table main-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.name') }}</th>
                            <th scope="col">@lang('Image')</th>
                            {{-- <th scope="col">{{ __('admin.Opening quantity') }}</th> --}}
                            <th scope="col">@lang('Current quantity')</th>
                            <th scope="col">{{ __('admin.paid_quantity') }}</th>
                            <th scope="col">{{ __('admin.selling_price') }}</th>
                            <th scope="col">{{ __('admin.sell_with_tax') }}</th>
                            <th scope="col">{{ __('admin.tax') }}</th>
                            <th scope="col">{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.Activate_quantity') }}</th>
                            <th>{{ __('admin.warehouse') }}</th>
                            <th>{{ __('admin.department') }}</th>
                            <th>{{ __('admin.Date') }}</th>
                            <th scope="col">@lang('QrCode')</th>
                            <th scope="col">{{ __('admin.managers') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                        $totalPaidQty = \App\Models\OrderItem::where('warehouse_id', auth()->user()->warehouse_id)
                        ->sum('quantity');
                        @endphp
                        @foreach ($items as $item)
                        @php
                        $paid_quantity = \App\Models\OrderItem::where('item_id', $item->id)
                        ->where('warehouse_id', auth()->user()->warehouse_id)
                        ->sum('quantity');

                        @endphp
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>
                                <img class="h-auto" width="50"
                                    src="{{$item->image ? display_file($item->image) :'https://placehold.co/400'}}"
                                    alt="صورة المنتج">
                            </td>
                            {{-- <td>{{ $item->open_quantity }}</td> --}}
                            <td class="{{ $item->quantity <= 5 ? 'text-danger' : '' }}">{{ $item->quantity }}</td>
                            <td>{{ $paid_quantity }}</td>
                            <td>{{ $item->sale_price }}</td>
                            <td>{{ $item->has_tax ? 'نعم' : 'لا' }}</td>
                            <td>{{ $item->tax }}</td>
                            <td>{{ $item->total }}</td>
                            <td>
                                {{ $item->allow_quantity ? __('admin.Activated') : __('admin.Not activated') }}
                            </td>

                            <td>
                                @if ($this->warehouse_id)
                                {{ $warehouse_data->name }}
                                @else
                                @foreach ($item->warehouses as $warehouse)
                                <p>{{ $warehouse->name }}</p>
                                @endforeach
                                @endif

                            </td>
                            <td>{{$item->category?->name}}</td>
                            <td>{{$item->created_at->format('Y-m-d')}}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#qrCode{{ $item->id }}"><i class="fa fa-qrcode"></i></button>
                                <div class="modal fade" id="qrCode{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">QrCode
                                                    عرض منتج</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex justify-content-center"
                                                id="printContent-{{ $item->id }}">
                                                {{ QrCode::size(150)->generate($item->id); }}
                                            </div>
                                            <div class="model-footer pb-3">
                                                <button onclick="printById('printContent-{{ $item->id }}')"
                                                    class="btn btn-warning btn-sm" id="">طباعة
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-center gap-1 text-nowrap">
                                    @can('report_items')
                                    <a href="{{ route('front.items_report', ['item' => $item->id]) }}"
                                        class="btn btn-sm trans-btn text-white space-noWrap">
                                        {{ __('admin.financial report') }}
                                    </a>
                                    @endcan

                                    @can('inventory_movement_items')
                                    <a href="{{ route('front.items.show', $item->id) }}"
                                        class="btn btn-sm btn-secondary">
                                        {{ __('admin.Inventory Movement') }}
                                    </a>

                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#quantities" wire:click="itemId({{ $item->id }})">
                                        {{ __('admin.quantities') }}
                                    </button>
                                    @endcan

                                    @can('charge_items')
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                        data-bs-target="#charge" wire:click="itemId({{ $item->id }})">
                                        {{ __('admin.charge') }}
                                    </button>
                                    @endcan

                                    @can('expense_items')
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#expense" wire:click="itemId({{ $item->id }})">
                                        {{ __('admin.expense') }}
                                    </button>
                                    @endcan
                                    <div class="dropdown drop-table">
                                        <button class="btn btn-outline-secondary btn-sm" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            @can('update_items')
                                            <li>
                                                <button type="button" class="dropdown-item text-center"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    wire:click="edit({{ $item->id }})">
                                                    {{ __('admin.Update') }}
                                                </button>
                                            </li>
                                            @endcan
                                            <li>
                                                <button type="button" class="dropdown-item text-center"
                                                    data-bs-toggle="modal" data-bs-target="#show{{$item->id}}">
                                                    {{ __('admin.Show') }}
                                                </button>
                                            </li>

                                            @can('delete_items')
                                            <li>
                                                <button type="button" class="dropdown-item text-center"
                                                    data-bs-toggle="modal" data-bs-target="#delete{{ $item->id }}">
                                                    {{ __('admin.Delete') }}
                                                </button>
                                            </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @include('front.items.delete')
                        <div class="modal fade" id="show{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $name ? __('admin.Update') :
                                            __('admin.Add') }}
                                            عرض منتج</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row row-gap-24">

                                            <div class=" col-sm-6 d-flex gap-3">
                                                <label class="small-label" for="">{{ __('admin.name') }}:</label>
                                                {{$item->name}}
                                            </div>
                                            <div class=" col-sm-6">
                                                @if($item->barcode)
                                                {!! DNS1D::getBarcodeHTML($item->barcode . '', 'C128') !!}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                        <tr>
                            <th colspan="2">الاجمالي</th>
                            {{-- <td>{{ $items->sum('open_quantity') }}</td> --}}
                            <td></td>
                            <td>{{ $items->sum('quantity') }}</td>
                            <td>{{ $totalPaidQty }}</td>
                        </tr>
                    </tbody>
                </table>
                {{ $items->links() }}
            </div>
        </div>
        <!-- All Modal -->
        <!-- Modal repeat -->
    </div>
    <div class="modal fade" id="importModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">رفع ملف المنتجات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">ملف Excel</label>
                        <input type="file" class="form-control" wire:model.defer='importFile'>
                        @error('importFile')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">حذف الكل قبل الرفع</label>
                        <input type="checkbox" class="form-check" wire:model.defer='importFileDeleteAll'>
                        @error('importFileDeleteAll')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button class="btn-main-sm mt-3" wire:click='import'>رفع</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close')
                        }}</button>
                    <button wire:click='import' type="button" class="btn btn-primary" data-bs-dismiss="modal">{{
                        __('admin.Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteAllModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('admin.Delete all products') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('admin.Are you sure to delete all products?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('admin.Close')
                        }}</button>
                    <button wire:click='deleteAll()' type="button" class="btn btn-primary" data-bs-dismiss="modal">{{
                        __('admin.Yes') }}</button>
                </div>
            </div>
        </div>
    </div>

</section>

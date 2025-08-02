<section class="main-section home">
    <div class="container">
        <x-alert></x-alert>
        <h4 class="main-heading">{{ __('orders') }}</h4>
        <div class="p-4 shadow rounded-3 bg-white">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                <div class="d-flex align-items-center justify-content-start flex-wrap gap-1">
                    <button class="btn btn-secondary btn-sm px-3"
                        wire:click="$set('filter_status','')">{{ __('admin.All') }}
                        {{ App\Models\Order::count() }}</button>
                    <button class="btn btn-success btn-sm px-3"
                        wire:click="$set('filter_status','paid')">{{ __('admin.Paid') }}
                        {{ App\Models\Order::where('status', 'paid')->count() }}</button>
                    <button class="btn btn-danger btn-sm px-3"
                        wire:click="$set('filter_status','unpaid')">{{ __('admin.spoon') }}
                        {{ App\Models\Order::where('status', 'unpaid')->count() }}</button>
                    <button class="btn btn-warning btn-sm px-3"
                        wire:click="$set('filter_status','retrieved')">{{ __('admin.retrieved') }}
                        {{ App\Models\Order::where('status', 'retrieved')->count() }}</button>
                </div>
                <div class="btn-holder d-flex gap-2">
                    @can('read_items')
                        <a class="btn-primary btn fs-13px" href="{{ route('front.items') }}">
                            {{ __('admin.Products') }}
                            <i class="fa-solid fa-tags me-1"></i>
                        </a>
                    @endcan
                    @can('read_warehouses')
                        <a class="btn-info btn fs-13px" href="{{ route('front.warehouses') }}">
                            @lang('Warehouse products')
                            <i class="fa-solid fa-tags me-1"></i>
                        </a>
                    @endcan
                    <a class="btn-main-sm fs-13px" href="{{ route('front.orders.create') }}">
                        {{ __('admin.Sale screen') }}
                        <i class="fa-solid fa-money-check-dollar me-1"></i>
                    </a>
                    <button wire:click="export" class="btn btn-sm btn-danger">
                        <i class="fa fa-file-excel"></i>
                        تصدير اكسل
                    </button>

                </div>
            </div>
            <div
                class="row row-cols-1 row-cols-sm-2 align-items-end row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3 mb-3">
                <div class="col">
                    <div class="inp-holder">
                        <input type="text" class="form-control"
                            placeholder="{{ __('admin.Search_by_invoice_number') }}" wire:model='searchinvoiveno'>
                    </div>
                </div>
                <div class="col">
                    <div class="inp-holder w-100">
                        <select name="" id="" wire:model='searchemployee' class="main-select w-100">
                            <option value="">{{ __('admin.Search_by_customer_name') }}</option>
                            @foreach (\App\Models\Patient::get() as $user)
                                <option value="{{ $user->name }}"> {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="inp-holder">
                        <input type="text" class="form-control" wire:model="barcode_search"
                            placeholder="{{ __('admin.Barcode') }}">
                    </div>
                </div>
                <div class="col">
                    <div class="inp-holder">
                        <label for="" class="small-label">{{ __('admin.from') }}</label>
                        <input type="date" class="form-control" wire:model="from">
                    </div>
                </div>
                <div class="col">
                    <div class="inp-holder">
                        <label for="" class="small-label">{{ __('admin.To') }}</label>
                        <input type="date" class="form-control" wire:model="to">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-2">
                <button type="button" class="btn btn-sm btn-warning" id="btn-prt-content">
                    <i class="fa-solid fa-print"></i>
                </button>
            </div>
            <div class="table-responsive" id="prt-content">
                <table class="table main-table mb-0" id="data-table">
                    <thead>
                        <tr>
                            <th>{{ __('admin.invoice_number') }}</th>
                            <th>{{ __('admin.Employee') }}</th>
                            <th>{{ __('admin.Client') }}</th>
                            <th>{{ __('admin.Products') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.tax') }}</th>
                            <th>{{ __('admin.Total') }}</th>
                            <th>{{ __('admin.Discount') }}</th>
                            <th>{{ __('admin.Cash') }}</th>
                            <th>{{ __('admin.card') }} - {{ __('admin.Mada') }}</th>
                            <th>{{ __('admin.rest') }}</th>
                            <th>{{ __('admin.Status') }}</th>
                            <th>{{ __('admin.Returner') }}</th>
                            <th class="not-print">{{ __('admin.Control') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user?->name }}</td>
                                <td>{{ $order->client ? $order->client->name : 'عميل نقدي' }}</td>
                                <td>
                                    @forelse ($order->items as $item)
                                        <span>{{ $item->name }} ( {{ __('admin.number') }} :
                                            {{ $item->quantity }})</span>
                                    @empty
                                        --
                                    @endforelse
                                </td>
                                <td>{{ $order->amount }}</td>
                                <td>{{ $order->tax }}</td>
                                <td>{{ $order->total }}</td>
                                <td>{{ $order?->discount }}</td>
                                <td>{{ $order->cash }}</td>
                                <td>{{ $order->card }}</td>
                                <td>{{ $order->rest }}</td>
                                <td>{{ __($order->status) }}</td>
                                <td>
                                    {{ $order->refund ? $order->refund . ' - ' . ($order->refund_status == 'creditor' ? __('admin.Creditor') : __('admin.Debtor')) : '' }}
                                </td>
                                <td class="not-print">
                                    <div class="d-flex flex-wrap align-items-center  gap-1">
                                        @if ($order->status != 'retrieved')
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#retrieved{{ $order->id }}">
                                                {{ __('admin.Recovery') }}
                                            </button>
                                            @include('front.orders.retrieved')
                                        @endif
                                        <a href="{{ route('front.orders.show', $order->id) }}"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        @can('delete_invoices')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $order->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endcan

                                        @include('front.orders.delete')
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">{{ __('admin.total') }}</td>
                            <td>{{ $all_orders->sum('amount') }}</td>
                            <td>{{ $all_orders->sum('tax') }}</td>
                            <td>{{ $all_orders->sum('total') }}</td>
                            <td>{{ $all_orders->sum('discount') }}</td>
                            <td>{{ $all_orders->sum('cash') }}</td>
                            <td>{{ $all_orders->sum('card') }}</td>
                            <td>{{ $all_orders->sum('rest') }}</td>
                            <td colspan="3"></td>
                        </tr>
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</section>

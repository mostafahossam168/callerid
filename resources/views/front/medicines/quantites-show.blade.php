@extends('front.layouts.front')
@section('title', $item->name)
@section('content')
    <section class="main-section" style="height: 474px;">
        <div class="container h-100">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <h4 class="main-heading">{{ $item->name }}</h4>
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <a type="button" class="btn btn-sm btn-secondary" href="{{ route('front.pharmacy',['screen'=>'medicine']) }}">
                        {{ __('admin.Products') }}
                    </a>
                </div>
            </div>
            <div class="section-content p-4 bg-white rounded-3 shadow">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h5 class="text-center small-heading mb-2">{{ __('admin.Shipping operations') }}</h5>
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                <tr>
                                    <th>{{ __('admin.the_quantity') }}</th>
                                    <th>{{ __('admin.warehouse') }}</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th>{{ __('admin.Employee') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($item->quantities()->where('type', 'charge')->get() as $product)
                                    <tr>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->pharmacyWarehouse?->name }}</td>
                                        <td>{{ $product->created_at->isoFormat('Y-M-D') }}</td>
                                        <td>{{ $product->employee?->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <h5 class="text-center small-heading mb-2">{{ __('admin.Exchange operations') }}</h5>
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                <tr>
                                    <th>{{ __('admin.the_quantity') }}</th>
                                    <th>{{ __('admin.from_warehouse') }}</th>
                                    <th>{{ __('admin.to_warehouse') }}</th>
                                    <th>{{ __('admin.Date') }}</th>
                                    <th>{{ __('admin.Employee') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($item->quantities()->where('type', 'expense')->get() as $product)
                                    <tr>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->fromWarehouse?->name }}</td>
                                        <td>{{ $product->toWarehouse?->name }}</td>
                                        <td>{{ $product->created_at->isoFormat('Y-M-D') }}</td>
                                        <td>{{ $product->employee?->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

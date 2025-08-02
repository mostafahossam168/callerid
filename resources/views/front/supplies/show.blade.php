@extends('front.layouts.front')
@section('title', $supply->name)
@section('content')

    <section class="main-section" style="height: 474px;">
        <div class="container h-100">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <h4 class="main-heading">{{ __('admin.category') }}: {{ $supply->kind->name }}</h4>
                <div class="d-flex align-items-center flex-wrap gap-1">
                    <a type="button" class="btn btn-sm btn-secondary"
                        href="{{ route('front.kinds') }}">مستودع العيادة <i class="fas fa-arrow-left-long"></i></a>
                    <a href="{{ route('front.supplies') }}" class="btn-main-sm px-3">{{ __('admin.kinds') }} <i class="fas fa-arrow-left-long"></i></a>
                </div>
            </div>
            <div class="section-content p-4 bg-white rounded-3 shadow">
                <div class="row">
                    <div class="col-6">
                        <h5 class="text-center small-heading mb-2">{{ __('admin.Shipping operations') }}</h5>
                        <div class="table-responsive">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin.Old quantity') }}</th>
                                        <th>{{ __('admin.quantity') }}</th>
                                        <th>{{ __('admin.total') }}</th>
                                        <th>{{ __('admin.price') }}</th>
                                        <th>{{ __('admin.Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supply->quantities->where('type', 'in') as $item)
                                        <tr>
                                            <td>{{ $item->old_quantity }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->quantity + $item->old_quantity }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->created_at->isoFormat('Y-M-D') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="">
                                        <td></td>
                                        <td>{{ $supply->quantities->where('type', 'in')->sum('quantity') }}</td>
                                        <td></td>
                                        <td>{{ $supply->quantities->where('type', 'in')->sum('price') }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <h5 class="text-center small-heading mb-2">{{ __('admin.Exchange operations') }}</h5>
                        <div class="table-responsive ">
                            <table class="table main-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('admin.quantity') }}</th>
                                        <th>{{ __('admin.Dr') }}</th>
                                        <th>{{ __('admin.the clinic') }}</th>
                                        <th>{{ __('admin.price') }}</th>
                                        <th>{{ __('admin.Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($supply->quantities->where('type', 'out') as $item)
                                        <tr>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->doctor?->name }}</td>
                                            <td>{{ $item->clinic?->name }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->created_at->isoFormat('Y-M-D') }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="">
                                        <td>{{ $supply->quantities->where('type', 'out')->sum('quantity') }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ $supply->quantities->where('type', 'out')->sum('price') }}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection

@extends('admin.layouts.admin')
@section('title')
    نسب الخدمات
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page"> نسب الخدمات</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('admin.product_percents.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table main-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم الطبيب</th>
                    <th scope="col">{{ __('admin.Product name') }}</th>
                    <th scope="col">النسبة</th>
                    <th scope="col">{{ __('admin.managers') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product_percents as $product_percent)
                    <tr>
                        <th scope="row">{{ $loop->index + 1 }}</th>
                        <td>{{ $product_percent->doctor?->name }}</td>
                        <td>{{ $product_percent->product?->name }}</td>
                        <td>{{ $product_percent->percent }}%</td>
                        <td>
                            <a class="btn btn-info btn-sm"
                                href="{{ route('admin.product_percents.edit', $product_percent) }}">{{ __('admin.Update') }}</a>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $product_percent->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.product_percents.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $product_percents->links() }}

    </div>
@endsection

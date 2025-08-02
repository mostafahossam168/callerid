@extends('admin.layouts.admin')
@section('title')
{{-- {{ __('admin.maincategories') }} --}}
السلالات
@endsection
@section('content')
<nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            {{-- <li class="breadcrumb-item active" aria-current="page">{{ __('admin.maincategories') }}</li> --}}
            <li class="breadcrumb-item active" aria-current="page">السلالات</li>

        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <a href="{{ route('admin.strains.create') }}"  class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
        <table class="table main-table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('admin.name') }}</th>
                    <th scope="col">{{__('admin.category')}}</th>

                    <th scope="col">{{ __('admin.managers') }}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($strains as $strain)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $strain->name }}</td>
                        <td>{{ $strain->category?->name }}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.strains.edit',$strain) }}">{{ __('admin.Update') }}</a>
                            {{-- <a class="btn btn-danger btn-sm" href="{{ route('admin.invoices.index',['category_id'=>$category->id]) }}">
                                {{ __('admin.') }}
                                <i class="fa fa-file-invoice-dollar"></i>
                            </a> --}}

                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#delete_agent{{ $strain->id }}"><i></i>
                                {{ __('admin.Delete') }}
                            </button>
                            @include('admin.strains.delete')
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $strains->links() }}

    </div>

@endsection

@extends('admin.layouts.admin')
@section('title')
أقسام المختبرات
@endsection
@section('content')
<nav aria-label="breadcrumb ">
    <ol class="breadcrumb bg-light p-3">
        <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
        <li class="breadcrumb-item active" aria-current="page">{{ __('Laboratory Departments')}}</li>
    </ol>
</nav>
<div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
    <a href="{{ route('admin.lab-categories.create') }}" class="btn mb-3 btn-primary">{{ __('admin.Add') }}</a>
    <table class="table main-table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('admin.name') }}</th>
                <th scope="col">{{ __('admin.managers') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($index as $cat)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $cat->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.lab-categories.edit',$cat) }}">{{ __('admin.Update') }}</a>


                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete_agent{{ $cat->id }}"><i></i>
                        {{ __('admin.Delete') }}
                    </button>
                    @include('admin.lab-category.delete')
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   {{ $index->links() }}

</div>

@endsection

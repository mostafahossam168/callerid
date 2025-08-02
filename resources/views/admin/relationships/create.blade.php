@extends('admin.layouts.admin')
@section('title')
{{ __('admin.Add relationship') }}
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Add relationship') }}</li>
        </ol>
    </nav>
    <div class="row w-100 mx-auto p-3 shadow rounded-3  bg-white">

        <form action="{{ route('admin.relationships.store') }}" method="POST">
            @csrf
            <label for="">{{ __('admin.name') }}</label>
            <input type="text" name="name">
            <button   class="btn btn-primary">{{ __('admin.Add') }}</button>
        </form>

    </div>

@endsection

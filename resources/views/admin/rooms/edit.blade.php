@extends('admin.layouts.admin')
@section('title')
    {{ __('admin.Edit room') }}
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.Edit room') }}</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>{{ __('admin.Edit room') }}</b>
        <hr>
        <form class="row" action="{{ route('admin.rooms.update', $room) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-md-4">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="form-control" type="text" name="name" value="{{ $room->name }}">
            </div>

            <div class="col-12 text-center mt-5">
                <button class="btn btn-primary">{{ __('admin.Update') }}</button>

            </div>
        </form>

    </div>
@endsection

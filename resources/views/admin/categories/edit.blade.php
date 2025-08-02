@extends('admin.layouts.admin')
@section('title')
تعديل قسم
@endsection
@section('content')

    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">تعديل قسم</li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b>تعديل قسم</b>
        <hr>
        <form class="row" action="{{ route('admin.categories.update',$Category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-sm-6">
                <label class="main-lable" for="">{{ __('admin.name') }}</label>
                <input class="main-select w-100" type="text" name="name" value="{{ $Category->name }}">
            </div>
            <div class="col-sm-6">
            <label class="main-lable" for="">{{ __('admin.sub of') }}</label>
            <select class="main-select w-100" name="parent" id="">
            <option value="">{{ __('admin.Choose the category') }}</option>
            @foreach ($main_categories as $cat)
                <option {{ $Category->parent==$cat->id?'selected':'' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
            </select>
            </div>



            <div class="col-12 mt-5 text-center">
            <button   class="btn btn-primary">{{ __('admin.Update') }}</button>
            </div>
        </form>

    </div>

@endsection

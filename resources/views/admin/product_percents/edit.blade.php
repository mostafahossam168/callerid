@extends('admin.layouts.admin')
@section('title')
    تعديل نسبة لخدمة
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page"> تعديل نسبة لخدمة
            </li>
        </ol>
    </nav>
    <div class=" w-100 mx-auto p-3 shadow rounded-3  bg-white">
        <b> تعديل نسبة لخدمة</b>
        <hr>
        <form class="row" action="{{ route('admin.product_percents.update', $product_percent->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-sm-6">
                <label class="main-lable" for="">{{__('admin.Choose the doctor')}}</label>
                <select class="main-select w-100" name="doctor_id" id="">
                    <option value="">اختر</option>
                    @foreach ($doctors as $doctor)
                        <option value="{{ $doctor->id }}"
                            {{ $product_percent->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-6">
                <label class="main-lable" for="">اختر الخدمة</label>
                <select class="main-select w-100" name="product_id" id="">
                    <option value="">اختر</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ $product_percent->product_id == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="main-lable" for="">النسبة</label>
                <input class="form-control" type="text" name="percent" value="{{ $product_percent->percent }}">
            </div>


            <div class="col-12 text-center mt-5">
                <button class="btn btn-primary" type="submit">{{ __('admin.Update') }}</button>
            </div>
        </form>

    </div>
@endsection

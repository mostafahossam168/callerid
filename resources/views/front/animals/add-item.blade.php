@extends('front.layouts.front')
@section('title')
اضافة سلالة
@endsection
@section('content')
<section class="main-section">
  <div class="container">
    <h4 class="main-heading mb-4">أضافة سلالة</h4>

    <div class="p-3 shadow rounded-3  bg-white">
      <form class="row g-3" action="{{ route('front.save-item') }}" method="POST">
        @csrf
        <div class="col-sm-6">
          <label class="small-label" for="">{{ __('admin.name') }}</label>
          <input class="form-control" type="text" name="name">
        </div>

        <div class="col-sm-6">
          <label class="small-label" for="">{{__('admin.category')}}</label>
          <select class="main-select w-100" name="category_id" id="">
            <option value="">اختر من الاقسام</option>
            @foreach ($main_categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 mt-5 text-center">
          <button class="btn btn-success btn-sm px-4">{{ __('admin.Add') }}</button>
        </div>
      </form>

    </div>
  </div>
</section>

@endsection

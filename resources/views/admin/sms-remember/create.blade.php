@extends('admin.layouts.admin')
@section('title','انشاء رسالة جديدة')
@section('content')
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">انشاء رسالة جديدة</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sms.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="">عنوان الرسالة</label>
                    <input type="text" name="title" id="" class="form-control" value="{{ old('title') }}">
                </div>

{{--   <div class="form-group">
                    <label for=""> الرسالة</label>
                    <input type="text" name="message" id="" class="form-control" >
                </div>--}}


                <div class="form-group col-sm-12">
            <label class="main-lable" for="">رسالة التذكير</label>
            <textarea name="message" rows="5" class="form-control" placeholder="رسالة التذكير">{{ setting()->sms_remember }}</textarea>
        </div>

                <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection

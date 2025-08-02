@extends('admin.layouts.admin')
@section('title','تعديل رسالة ')
@section('content')
<div class="content-header">
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تعديل رسالة </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.sms.update', $sms) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">عنوان الرسالة</label>
                    <input type="text" name="title" id="" class="form-control" value="{{ $sms->title }}" >
                </div>

                <div class="form-group col-sm-12">
            <label class="main-lable" for="">رسالة التذكير</label>
            <textarea name="message" rows="5" class="form-control" >{{ $sms->message }}</textarea>
        </div>


                <button type="submit" class="btn btn-primary">{{ __('admin.save') }}</button>
            </form>
        </div>
    </div>
</div>

@section('js')


<!-- SlimScroll -->
<script src="{{asset('adminlte-rtl/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('adminlte-rtl/plugins/fastclick/fastclick.js')}}"></script>

@endsection
@endsection

@extends('admin.layouts.admin')
@section('title','تعديل سؤال ')
@section('content')
<div class="content-header">
<!-- Main content -->
<div class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">تعديل سؤال </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.questions.update',$edit->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">عنوان السؤال</label>
                    <input type="text" name="title" id="" class="form-control" value="{{ old('title',$edit->title) }}">
                </div>
                <div class="form-group">
                    <label for="">إجابات السؤال</label>
                    <small class="text-danger">ضع بين كل اجابة اشارة "-"</small>
                    <input type="text" name="answers" id="" class="form-control" value="{{implode( '-',$edit->answers) }}">
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

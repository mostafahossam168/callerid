@extends('admin.layouts.admin')
@section('title')
   رسائل التذكير
@endsection
@section('content')
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb bg-light p-3">
            <a href='{{ route('admin.home') }}' class="breadcrumb-item " aria-current="page">{{ __('admin.home') }}</a>
            <li class="breadcrumb-item active" aria-current="page">رسائل التذكير</li>
        </ol>
    </nav>

    <form class="row row-gap-24 p-3 shadow rounded-3 bg-white w-100 mx-auto" action="{{ route('admin.settings.update') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-12">
            <b>{{ __('admin.Settings') }}</b>
            <hr>
        </div>
     

        <?php $setting = \App\Models\Setting::latest()->first(); ?>
     
        <div class="form-group col-sm-12">
            <label class="main-lable" for="">رسالة التذكير</label>
            <textarea name="sms_remember" rows="5" class="form-control" placeholder="رسالة التذكير">{{ setting()->sms_remember }}</textarea>
        </div>
       


 
        <div class="col-12 text-center mt-5">
            <button type="submit" class="btn btn-primary">{{ __('admin.Save') }}</button>
        </div>
    </form>
 
@endsection
@push('js')
    <script>
        $(".img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".img-preview").attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
